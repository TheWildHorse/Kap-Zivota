package kap.trippleit.com.kapzivota;

import android.app.Activity;
import android.app.MediaRouteButton;
import android.content.Intent;
import android.location.Address;
import android.location.Geocoder;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.pushbots.push.Pushbots;

import java.util.List;
import java.util.Locale;

/**
 * Created by root on 22.11.14..
 */
public class Home extends Activity implements View.OnClickListener {

    TextView tvHome;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.home);

        Button b1 = (Button) findViewById(R.id.btnHomeViewDonations);
        Button b2 = (Button) findViewById(R.id.btnHomeInstitutionList);
        Button b3 = (Button) findViewById(R.id.btnHomeStatistics);
        Button b4 = (Button) findViewById(R.id.btnHomeReminder);
        Button b5 = (Button) findViewById(R.id.btnHomeCanIDonate);
        Button b6 = (Button) findViewById(R.id.btnHomeProfileSettings);
        Button b7 = (Button) findViewById(R.id.btnHomeSettings);

        b1.setOnClickListener(this);
        b2.setOnClickListener(this);
        b3.setOnClickListener(this);
        b4.setOnClickListener(this);
        b5.setOnClickListener(this);
        b6.setOnClickListener(this);
        b7.setOnClickListener(this);

        tvHome = (TextView) findViewById(R.id.tvHome);

        Pushbots.init(Home.this, "30119727242", "54705e2f1d0ab18e108b4595");
        Pushbots.getInstance().setMsgReceiver(CustomPushReceiver.class);
    }

    @Override
    public void onClick(View v) {
        Intent i = null;
        switch (v.getId()) {
            case R.id.btnHomeViewDonations:
                i = new Intent("kap.trippleit.com.kapzivota.VIEWDONATIONS");
                break;
            case R.id.btnHomeInstitutionList:
                i = new Intent("kap.trippleit.com.kapzivota.INSTITUTIONLIST");
                break;
            case R.id.btnHomeStatistics:
                i = new Intent("kap.trippleit.com.kapzivota.STATISTICS");
                break;
            case R.id.btnHomeReminder:
                i = new Intent("kap.trippleit.com.kapzivota.REMINDER");
                break;
            case R.id.btnHomeCanIDonate:
                i = new Intent("kap.trippleit.com.kapzivota.CANIDONATE");
                break;
            case R.id.btnHomeProfileSettings:
                i = new Intent("kap.trippleit.com.kapzivota.REGISTRATIONUSERDATA");
                break;
            case R.id.btnHomeSettings:
                break;
        }
        if (i != null) {
            startActivity(i);
        }
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
