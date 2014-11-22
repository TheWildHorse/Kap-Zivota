package kap.trippleit.com.kapzivota;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;

/**
 * Created by root on 22.11.14..
 */
public class Login extends Activity implements View.OnClickListener {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.login);
        Button b1 = (Button) findViewById(R.id.btnLoginLogin);
        b1.setOnClickListener(this);
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.btnLoginLogin:
                Intent i = new Intent("kap.trippleit.com.kapzivota.HOME");
                startActivity(i);
                break;
            case R.id.btnLoginPassReset:
                break;
        }

    }
}
