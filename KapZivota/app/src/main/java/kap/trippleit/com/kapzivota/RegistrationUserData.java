package kap.trippleit.com.kapzivota;

import android.app.Activity;
import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

/**
 * Created by root on 22.11.14..
 */
public class RegistrationUserData extends Activity implements View.OnClickListener {

    Button save;

    EditText etUserprofileUserid, etUserprofileName, etUserprofileSurname, etUserprofileBirthday, etUserprofileEmail;
    Spinner gender, blod;

    JSONObject root;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.userprofile);

        save = (Button) findViewById(R.id.btnUserprofileSave);
        save.setOnClickListener(this);
        etUserprofileUserid = (EditText) findViewById(R.id.etUserprofileUserid);
        etUserprofileName = (EditText) findViewById(R.id.etUserprofileName);
        etUserprofileSurname = (EditText) findViewById(R.id.etUserprofileSurname);
        etUserprofileBirthday = (EditText) findViewById(R.id.etUserprofileBirthday);
        etUserprofileEmail = (EditText) findViewById(R.id.etUserprofileEmail);

        gender = (Spinner) findViewById(R.id.sUserprofileGender);
        blod = (Spinner) findViewById(R.id.sUserprofileBlodId);

        root = new JSONObject();
        new Read().execute();


        etUserprofileBirthday.setOnClickListener(this);

    }

    @Override
    public void onClick(View v) {

        Log.d("KRUNO", "ok");
        if (v.getId() == R.id.etUserprofileBirthday) {
            final Calendar c = Calendar.getInstance();
            int mYear = c.get(Calendar.YEAR);
            int mMonth = c.get(Calendar.MONTH);
            int mDay = c.get(Calendar.DAY_OF_MONTH);

            /*
            if (!etUserprofileBirthday.getText().toString().isEmpty()) {
                try {
                    Date date = new SimpleDateFormat("yyyy-MM-dd").parse(etUserprofileBirthday.getText().toString());
                    mYear = date.getYear();
                    mMonth = date.getMonth();
                    mDay = date.getDay();
                    Log.d("KRUNO", "OK");

                } catch (ParseException e) {
                    Log.d("KRUNO", "ERROR");
                }
            }
            */

            DatePickerDialog dpd = new DatePickerDialog(this,
                    new DatePickerDialog.OnDateSetListener() {
                        @Override
                        public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                            etUserprofileBirthday.setText(dayOfMonth + "-" + (monthOfYear + 1) + "-" + year);
                        }
                    }, mYear, mMonth, mDay);
            dpd.show();
            return;
        }

        JSONObject userData = new JSONObject();
        try {

            root.put("id", Singleton.getUser_id(this));
            root.put("api_key", Singleton.getApi_key(this));

            userData.put("id", Integer.parseInt(etUserprofileUserid.getText().toString()));
            userData.put("name", etUserprofileName.getText().toString());
            userData.put("surname", etUserprofileSurname.getText().toString());
            if (blod.getSelectedItemPosition() != 0) {
                userData.put("blood_id", blod.getSelectedItemPosition());
            }
            if (gender.getSelectedItemPosition() == 0) {
                userData.put("gender", "M");
            } else {
                userData.put("gender", "Z");
            }
            userData.put("email", etUserprofileEmail.getText().toString());

            String b = etUserprofileBirthday.getText().toString();

            Date date = null;
            try {
                date = new SimpleDateFormat("dd-MM-yyyy").parse(b);
                b = new SimpleDateFormat("yyyy-MM-dd").format(date);
            } catch (Exception ex) {
            }
            userData.put("birthdate", b);

            root.put("data", userData);

        } catch (JSONException e) {
            e.printStackTrace();
        }

        new PostData().execute();
    }

    public class PostData extends AsyncTask<String, Integer, String> {
        @Override
        protected String doInBackground(String... params) {
            HttpClient httpclient = new DefaultHttpClient();
            HttpPost httppost = new HttpPost("http://178.62.168.32/api/users/edit");

            try {
                Log.d("KRUNO", root.toString());
                httppost.setEntity(new StringEntity(root.toString(), "UTF-8"));
                HttpResponse r = httpclient.execute(httppost);

                int status = r.getStatusLine().getStatusCode();
                if (status == 200) {
                    HttpEntity e = r.getEntity();
                    String data = EntityUtils.toString(e);
                    return data;
                }
            } catch (ClientProtocolException e) {
            } catch (IOException e) {
            }
            return null;
        }

        @Override
        protected void onPostExecute(String data) {
            if (Integer.parseInt(data) == 1) {
                Toast.makeText(RegistrationUserData.this, "OK: " + data, Toast.LENGTH_LONG).show();
                Intent i = new Intent("kap.trippleit.com.kapzivota.HOME");
                startActivity(i);
            } else {
                Toast.makeText(RegistrationUserData.this, "OK: " + data, Toast.LENGTH_LONG).show();
            }

        }
    }


    public class Read extends AsyncTask<String, Integer, String> {

        ProgressDialog dialog;

        protected void onPreExecute() {
            dialog = new ProgressDialog(RegistrationUserData.this);
            dialog.setProgressStyle(ProgressDialog.STYLE_HORIZONTAL);
            dialog.setMax(100);
            dialog.show();
        }

        @Override
        protected String doInBackground(String... params) {
            publishProgress(10);
            try {
                String url = "http://178.62.168.32/api/users/" + Singleton.getUser_id(RegistrationUserData.this);
                Log.d("KRUNO", "URL: " + url);
                HttpGet get = new HttpGet(url);
                HttpClient client = new DefaultHttpClient();
                HttpResponse r = client.execute(get);
                int status = r.getStatusLine().getStatusCode();
                if (status == 200) {
                    HttpEntity e = r.getEntity();
                    String data = EntityUtils.toString(e);
                    return data;
                } else {
                    Toast.makeText(RegistrationUserData.this, "ERROR", Toast.LENGTH_LONG);
                }
            } catch (IOException e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(String s) {
            try {
                JSONObject root = new JSONObject(s);
                //JSONArray jArray = root.getJSONArray("user");
                Log.d("KRUNO", root.getJSONObject("user").getString("id"));

                etUserprofileUserid.setText(root.getJSONObject("user").getString("id"));
                etUserprofileEmail.setText(root.getJSONObject("user").getString("email"));
                etUserprofileBirthday.setText(root.getJSONObject("user").getString("birthdate"));

                etUserprofileName.setText(root.getJSONObject("user").getString("name"));
                etUserprofileSurname.setText(root.getJSONObject("user").getString("surname"));
                gender.setSelection(root.getJSONObject("user").getString("gender").compareTo("M") == 0 ? 0 : 1);
                blod.setSelection(Integer.parseInt(root.getJSONObject("user").getString("blood_id")));

                dialog.dismiss();

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }

        @Override
        protected void onProgressUpdate(Integer... values) {
            super.onProgressUpdate(values);
            dialog.incrementProgressBy(values[0]);
        }

    }


}
