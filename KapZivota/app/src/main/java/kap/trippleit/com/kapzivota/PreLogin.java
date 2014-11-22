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
public class PreLogin extends Activity implements View.OnClickListener {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.prelogin);

        Button b1 = (Button) findViewById(R.id.btnPreloginFacebook);
        Button b2 = (Button) findViewById(R.id.btnPreloginSignIn);
        Button b3 = (Button) findViewById(R.id.btnPreloginSignUp);
        b1.setOnClickListener(this);
        b2.setOnClickListener(this);
        b3.setOnClickListener(this);

    }

    @Override
    public void onClick(View v) {

        Intent i = null;
        switch (v.getId()) {
            case R.id.btnPreloginFacebook:
                break;
            case R.id.btnPreloginSignIn:
                i = new Intent("kap.trippleit.com.kapzivota.LOGIN");
                break;
            case R.id.btnPreloginSignUp:
                i = new Intent("kap.trippleit.com.kapzivota.REGISTRATION");
                break;
        }
        if (i != null)
            startActivity(i);
    }
}
