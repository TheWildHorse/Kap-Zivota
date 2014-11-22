package kap.trippleit.com.kapzivota;

import android.app.Activity;
import android.app.IntentService;
import android.app.Service;
import android.content.Intent;
import android.os.Bundle;
import android.os.IBinder;
import android.view.Window;
import android.view.WindowManager;

import com.pushbots.push.Pushbots;

/**
 * Created by root on 22.11.14..
 */
public class Splash extends Activity {



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.splash);

        Thread gcm = new Thread() {
            @Override
            public void run() {
                super.run();
                Pushbots.init(Splash.this, "30119727242", "54705e2f1d0ab18e108b4595");
                Pushbots.getInstance().setMsgReceiver(CustomPushReceiver.class);
            }
        };
        gcm.start();

        Thread timer = new Thread() {
            @Override
            public void run() {
                super.run();
                try {
                    sleep(3000);
                } catch (InterruptedException e) {
                    e.printStackTrace();
                } finally {
                    Intent i = new Intent("kap.trippleit.com.kapzivota.LANGUAGE");
                    startActivity(i);
                }
            }
        };
        timer.start();


    }

    @Override
    protected void onPause() {
        super.onPause();
        finish();
    }

}
