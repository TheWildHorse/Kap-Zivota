package kap.trippleit.com.kapzivota;

import android.app.Activity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.Window;
import android.view.WindowManager;

import com.pushbots.push.Pushbots;


public class MainActivity extends Activity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);



        setContentView(R.layout.splash);


        Pushbots.init(this, "30119727242", "54705e2f1d0ab18e108b4595");

        Pushbots.getInstance().setMsgReceiver(CustomPushReceiver.class);
/*
        PBGenerateCustomNotification PBCustom = new PBGenerateCustomNotification();
        PBCustom.layout = R.layout.activity_main;
        PBCustom.titleId = R.id.title;
        PBCustom.messageId = R.id.message;
        PBCustom.iconId = R.id.image;
        PBCustom.icondId = R.drawable.ic_launcher;
        Pushbots.getInstance().setNotificationBuilder(PBCustom);
        */

    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        int id = item.getItemId();

        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }


    static boolean active = false;

    @Override
    public void onStart() {
        super.onStart();
        active = true;
    }

    @Override
    public void onStop() {
        super.onStop();
        active = false;
    }

    public static boolean isActive() {
        return active;
    }

}
