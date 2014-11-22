package kap.trippleit.com.kapzivota;

import android.app.Activity;
import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;

/**
 * Created by root on 22.11.14..
 */
public class RegistrationUserData extends Activity implements View.OnClickListener {

    Button save;

    EditText etUserprofileUserid, etUserprofileName, etUserprofileSurname, etUserprofileBirthday, etUserprofileEmail;
    Spinner gender, blod;


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

        new Read().execute();
    }

    @Override
    public void onClick(View v) {

        JSONObject root = new JSONObject();
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
            userData.put("birthdate", etUserprofileBirthday.getText().toString());

            root.put("data", userData);

        } catch (JSONException e) {
            e.printStackTrace();
        }

        Log.d("KRUNO", "" + root.toString());
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
