package kap.trippleit.com.kapzivota;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

/**
 * Created by root on 22.11.14..
 */
public class Registration extends Activity implements View.OnClickListener {

    Button b;
    EditText email, pass, passRe;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.register);

        email = (EditText) findViewById(R.id.etRegisterEmail);
        pass = (EditText) findViewById(R.id.etRegisterPassword1);
        passRe = (EditText) findViewById(R.id.etRegisterPassword2);

        b = (Button) findViewById(R.id.btnRegisterRegister);
        b.setOnClickListener(this);

    }

    @Override
    public void onClick(View v) {
        String e = email.getText().toString();
        String p1 = pass.getText().toString();
        String p2 = passRe.getText().toString();
        String EMAIL_PATTERN = "^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$";
        Pattern pattern = Pattern.compile(EMAIL_PATTERN);
        Matcher matcher = pattern.matcher(e);

        if (matcher.matches()) {
            if (p1.equals(p2) && p1.length() > 3) {
                new PostData().execute();
            } else {
                Toast.makeText(Registration.this, Registration.this.getResources().getString(R.string.regPassError1), Toast.LENGTH_LONG).show();
            }
        } else {
            Toast.makeText(Registration.this, Registration.this.getResources().getString(R.string.regPassError2), Toast.LENGTH_LONG).show();
        }
    }


    public class PostData extends AsyncTask<String, Integer, String> {
        @Override
        protected String doInBackground(String... params) {
            HttpClient httpclient = new DefaultHttpClient();
            HttpPost httppost = new HttpPost("http://178.62.168.32/api/users/register");

            try {
                List<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>(2);
                nameValuePairs.add(new BasicNameValuePair("email", email.getText().toString()));
                nameValuePairs.add(new BasicNameValuePair("password", pass.getText().toString()));
                httppost.setEntity(new UrlEncodedFormEntity(nameValuePairs));

                HttpResponse r = httpclient.execute(httppost);

                int status = r.getStatusLine().getStatusCode();
                if (status == 200) {
                    HttpEntity e = r.getEntity();
                    String data = EntityUtils.toString(e);
                    return data;
                }


            } catch (ClientProtocolException e) {
                // TODO Auto-generated catch block
            } catch (IOException e) {
                // TODO Auto-generated catch block
            }


            return null;
        }

        @Override
        protected void onPostExecute(String data) {
            if (data == null || data.isEmpty()) {
                Toast.makeText(Registration.this, Registration.this.getResources().getString(R.string.regPassError3), Toast.LENGTH_LONG).show();
                return;
            }
            boolean ok = true;
            try {
                JSONObject root = new JSONObject(data);
                String api = root.getString("api");
                String id = root.getString("id");

                Singleton.setApi_key(Registration.this, api);
                Singleton.setUser_id(Registration.this, id);

            } catch (JSONException e1) {
                ok = false;
                e1.printStackTrace();
            }
            if (ok) {
                Toast.makeText(Registration.this, "OK", Toast.LENGTH_LONG).show();
                Intent i = new Intent("kap.trippleit.com.kapzivota.REGISTRATIONUSERDATA");
                startActivity(i);
            } else {
                Toast.makeText(Registration.this, Registration.this.getResources().getString(R.string.regPassError3), Toast.LENGTH_LONG).show();
            }
        }
    }


}
