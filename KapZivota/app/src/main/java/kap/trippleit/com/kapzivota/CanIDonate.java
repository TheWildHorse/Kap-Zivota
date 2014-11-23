package kap.trippleit.com.kapzivota;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
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
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

/**
 * Created by root on 23.11.14..
 */
public class CanIDonate extends Activity implements View.OnClickListener {

    EditText etDonationGender, etDonationBirthday, etWeight, etDonationLast;
    Spinner sDonationChronic, sDonationInfecious;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.canidonate);
        etDonationGender = (EditText) findViewById(R.id.etDonationGender);
        etDonationBirthday = (EditText) findViewById(R.id.etDonationBirthday);
        etWeight = (EditText) findViewById(R.id.etWeight);
        etDonationLast = (EditText) findViewById(R.id.etDonationLast);
        sDonationChronic = (Spinner) findViewById(R.id.sDonationChronic);
        sDonationInfecious = (Spinner) findViewById(R.id.sDonationInfecious);

        Button b1 = (Button) findViewById(R.id.btnDonationsCheck);
        b1.setOnClickListener(this);

        new ReadLastDonateDate().execute();
        new Read().execute();
    }

    @Override
    public void onClick(View v) {
        boolean ok = true;

        if (etWeight.length() <= 0) {
            Toast.makeText(CanIDonate.this, "Niste upisali kilažu", Toast.LENGTH_LONG).show();
            return;
        }

        if (Integer.parseInt(etDonationLast.getText().toString()) != 0) {
            ok = false;
            //Toast.makeText(CanIDonate.this, "0", Toast.LENGTH_LONG).show();
        }

        if (Float.parseFloat(etDonationBirthday.getText().toString()) < 18) {
            ok = false;
            //Toast.makeText(CanIDonate.this, "1", Toast.LENGTH_LONG).show();
        }

        if (Integer.parseInt(etWeight.getText().toString()) < 55) {
            ok = false;
            //Toast.makeText(CanIDonate.this, "2", Toast.LENGTH_LONG).show();
        }

        if (sDonationChronic.getSelectedItemPosition() == 0) {
            ok = false;
            //Toast.makeText(CanIDonate.this, "3", Toast.LENGTH_LONG).show();
        }

        if (sDonationInfecious.getSelectedItemPosition() == 0) {
            Toast.makeText(CanIDonate.this, "4", Toast.LENGTH_LONG).show();
            ok = false;
        }


        if (ok) {
            DialogInterface.OnClickListener dialogClickListener = new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialog, int which) {
                    Intent i = null;
                    switch (which) {
                        case DialogInterface.BUTTON_POSITIVE:
                            i = new Intent("kap.trippleit.com.kapzivota.HOME");
                            break;
                        case DialogInterface.BUTTON_NEGATIVE:
                            i = new Intent("kap.trippleit.com.kapzivota.INSTITUTIONLIST");
                            break;
                    }
                    if (i != null)
                        startActivity(i);
                }
            };
            AlertDialog.Builder builder = new AlertDialog.Builder(this);
            builder.setMessage("Vi ste spremini za donaciju! \n Pronađite vama najbližu lokaciju za doniranje").setPositiveButton("Izlaz", dialogClickListener).setNegativeButton("Pokažimi gdje da doniram", dialogClickListener).show();
        } else {
            DialogInterface.OnClickListener dialogClickListener = new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface dialog, int which) {
                    Intent i = new Intent("kap.trippleit.com.kapzivota.HOME");
                    startActivity(i);
                }
            };
            AlertDialog.Builder builder = new AlertDialog.Builder(this);
            builder.setMessage("Nažalost Vi trenutno ne možete donirati").setNegativeButton("Izlaz", dialogClickListener).show();
        }


    }


    public class Read extends AsyncTask<String, Integer, String> {

        @Override
        protected String doInBackground(String... params) {
            publishProgress(10);
            try {
                String url = "http://178.62.168.32/api/users/" + Singleton.getUser_id(CanIDonate.this);
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
                    Toast.makeText(CanIDonate.this, "ERROR", Toast.LENGTH_LONG);
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
                Log.d("KRUNO", root.getJSONObject("user").getString("id"));

                etDonationGender.setText(root.getJSONObject("user").getString("gender"));


                SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd");
                Date birthDate = sdf.parse(root.getJSONObject("user").getString("birthdate"));
                etDonationBirthday.setText("" + Singleton.getAge(birthDate));


            } catch (JSONException e) {
                e.printStackTrace();
            } catch (ParseException e) {
                e.printStackTrace();
            }
        }

    }

    public class ReadLastDonateDate extends AsyncTask<String, Integer, String> {

        @Override
        protected String doInBackground(String... params) {
            publishProgress(10);
            try {
                //String url = "http://178.62.168.32/api/statistics/user/" + Singleton.getUser_id(Reminder.this) + "/lastdonated";
                String url = "http://178.62.168.32/api/statistics/user/1/lastdonated";
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
                    Toast.makeText(CanIDonate.this, "ERROR", Toast.LENGTH_LONG);
                }
            } catch (IOException e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(String s) {

            int timeInDays = 0;
            //s = "2014-11-22 00:00:00";
            //s = "2014-7-22 00:00:00";
            //s = "0000-00-00 00:00:00";
            //s = "0";

            if (s.equals("0000-00-00 00:00:00") || s.equals("0")) {
            } else {
                try {

                    Calendar cal1 = Calendar.getInstance();
                    cal1.setTime(new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").parse(s));
                    cal1.add(Calendar.MONTH, 1);
                    Date dt1 = cal1.getTime();

                    Calendar cal = Calendar.getInstance();
                    cal.add(Calendar.MONTH, -2);
                    Date dt2 = cal.getTime();

                    long diff = dt2.getTime() - dt1.getTime();
                    long diffSeconds = diff / 1000 % 60;
                    long diffMinutes = diff / (60 * 1000) % 60;
                    long diffHours = diff / (60 * 60 * 1000);
                    int diffInDays = (int) ((dt2.getTime() - dt1.getTime()) / (1000 * 60 * 60 * 24));
                    timeInDays = diffInDays * (-1);
                    if (timeInDays < 0) timeInDays = 0;
                } catch (Exception e) {
                }
            }
            etDonationLast.setText("" + timeInDays);
        }
    }
}
