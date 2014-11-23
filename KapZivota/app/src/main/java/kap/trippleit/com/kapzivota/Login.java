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

/**
 * Created by root on 22.11.14..
 */
public class Login extends Activity implements View.OnClickListener {

    EditText email, pass;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.login);
        Button b1 = (Button) findViewById(R.id.btnLoginLogin);
        b1.setOnClickListener(this);
        email = (EditText) findViewById(R.id.etLoginEmail);
        pass = (EditText) findViewById(R.id.etLoginPassword);

        email.setText("kdomic7@gmail.com");
        pass.setText("1111");
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.btnLoginLogin:

                if(email.length()<2 || pass.length()<2){
                    Toast.makeText(Login.this, "Niese upisali sve potrebne podatke", Toast.LENGTH_LONG).show();
                } else {
                    Singleton.setUser_id(this,"1");
                    Singleton.setApi_key(this,"1");
                }

                Intent i = new Intent("kap.trippleit.com.kapzivota.HOME");
                startActivity(i);
                break;
            case R.id.btnLoginPassReset:
                break;
        }

    }

}
