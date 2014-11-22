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
public class Home extends Activity implements View.OnClickListener {
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


    }

    @Override
    public void onClick(View v) {
        Intent i = null;
        switch (v.getId()) {
            case R.id.btnHomeViewDonations:
                break;
            case R.id.btnHomeInstitutionList:
                i = new Intent("kap.trippleit.com.kapzivota.INSTITUTIONLIST");
                break;
            case R.id.btnHomeStatistics:
                break;
            case R.id.btnHomeReminder:
                break;
            case R.id.btnHomeCanIDonate:
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
}
