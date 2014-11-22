package kap.trippleit.com.kapzivota;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;

import com.pushbots.push.Pushbots;

/**
 * Created by root on 22.11.14..
 */
public class Language extends Activity implements View.OnClickListener {
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.language);

        Button b1 = (Button) findViewById(R.id.btnLanguageHr);
        Button b2 = (Button) findViewById(R.id.btnLanguageEng);
        b1.setOnClickListener(this);
        b2.setOnClickListener(this);

        //Pushbots.init(this, "30119727242", "54705e2f1d0ab18e108b4595");

        //Pushbots.getInstance().setMsgReceiver(CustomPushReceiver.class);

        if(!Singleton.getLanguage(this).isEmpty()){
            Intent i = new Intent("kap.trippleit.com.kapzivota.PRELOGIN");
            startActivity(i);
        }

    }

    @Override
    public void onClick(View v) {
        switch (v.getId()) {
            case R.id.btnLanguageHr:
                Singleton.setLanguage(this,"hr");;
                break;
            case R.id.btnLanguageEng:
                Singleton.setLanguage(this,"hr");;
                break;
        }

        Intent i = new Intent("kap.trippleit.com.kapzivota.PRELOGIN");
        startActivity(i);

    }
}
