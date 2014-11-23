package kap.trippleit.com.kapzivota;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;

import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;

/**
 * Created by root on 23.11.14..
 */
public class Reminder extends Activity implements View.OnClickListener {

    TextView tvReminderDays, tvReminderLastDonation;
    Button btnRemindersRedirect;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.reminder);

        tvReminderDays = (TextView) findViewById(R.id.tvReminderDays);
        tvReminderLastDonation = (TextView) findViewById(R.id.tvReminderLastDonation);
        btnRemindersRedirect = (Button) findViewById(R.id.btnRemindersRedirect);
        btnRemindersRedirect.setOnClickListener(this);
        btnRemindersRedirect.setVisibility(View.INVISIBLE);

        new Read().execute();
    }

    @Override
    public void onClick(View v) {
        Intent i = new Intent("kap.trippleit.com.kapzivota.INSTITUTIONLIST");
        startActivity(i);
    }

    public class Read extends AsyncTask<String, Integer, String> {

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
                    Toast.makeText(Reminder.this, "ERROR", Toast.LENGTH_LONG);
                }
            } catch (IOException e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(String s) {
            boolean ok = true;
            String date = "NIKAD";
            int timeInDays = 0;

            s = "2014-11-22 00:00:00";
            s = "2014-7-22 00:00:00";
            s = "0000-00-00 00:00:00";
            //s = "0";

            if (s.equals("0000-00-00 00:00:00") || s.equals("0")) {
                ok = true;
                date = "NIKAD";
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
                    date = dt1.getDate() + "." + dt1.getMonth() + ".";
                } catch (Exception e) {
                    ok = false;
                }
            }
            tvReminderDays.setText("" + timeInDays);
            tvReminderLastDonation.setText("Zadnja donacija: " + date);
            if (ok && timeInDays <= 0) {
                Toast.makeText(Reminder.this, "MOŽE", Toast.LENGTH_LONG).show();
                btnRemindersRedirect.setVisibility(View.VISIBLE);
            } else {
                Toast.makeText(Reminder.this, "NEMOŽE", Toast.LENGTH_LONG).show();
            }

        }
    }
}
