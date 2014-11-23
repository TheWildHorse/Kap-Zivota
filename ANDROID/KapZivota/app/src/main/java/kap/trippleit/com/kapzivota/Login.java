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

public class Login extends Activity implements View.OnClickListener {

    EditText email, pass;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.login);
        Button b1 = (Button) findViewById(R.id.btnLoginLogin);
        Button b2 = (Button) findViewById(R.id.btnLoginPassReset);
        b1.setOnClickListener(this);
        b2.setOnClickListener(this);
        email = (EditText) findViewById(R.id.etLoginEmail);
        pass = (EditText) findViewById(R.id.etLoginPassword);

    }

    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.btnLoginLogin:

                if (email.length() < 2 || pass.length() < 2) {
                    Toast.makeText(Login.this, "Niese upisali sve potrebne podatke", Toast.LENGTH_LONG).show();
                } else {
                    /*
                    Singleton.setUser_id(this, "1");
                    Singleton.setApi_key(this, "1");
                    Intent i = new Intent("kap.trippleit.com.kapzivota.HOME");
                    startActivity(i);
                    */
                    new PostData().execute();
                }

                break;
            case R.id.btnLoginPassReset:
                Toast.makeText(Login.this, "Not implemented :(", Toast.LENGTH_LONG).show();
                break;
        }
    }

    public class PostData extends AsyncTask<String, Integer, String> {
        @Override
        protected String doInBackground(String... params) {
            HttpClient httpclient = new DefaultHttpClient();
            HttpPost httppost = new HttpPost("http://178.62.168.32/api/users/login");

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
            //Toast.makeText(Login.this, data, Toast.LENGTH_LONG).show();

            if (data == null || data.isEmpty()) {
                Toast.makeText(Login.this, Login.this.getResources().getString(R.string.regPassError3), Toast.LENGTH_LONG).show();
                return;
            }

            boolean ok = true;
            try {
                JSONObject root = new JSONObject(data);
                String api = root.getString("api");
                String id = root.getString("id");

                Singleton.setApi_key(Login.this, api);
                Singleton.setUser_id(Login.this, id);

            } catch (JSONException e1) {
                ok = false;
                e1.printStackTrace();
            }
            if (ok) {
                Toast.makeText(Login.this, "OK", Toast.LENGTH_LONG).show();
                Intent i = new Intent("kap.trippleit.com.kapzivota.REGISTRATIONUSERDATA");
                startActivity(i);
            } else {
                Toast.makeText(Login.this, Login.this.getResources().getString(R.string.regPassError3), Toast.LENGTH_LONG).show();
            }
        }
    }

}
