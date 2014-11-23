package kap.trippleit.com.kapzivota;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.util.Log;

import com.pushbots.push.Pushbots;

import java.util.HashMap;

/**
 * Created by root on 22.11.14..
 */
public class CustomPushReceiver extends BroadcastReceiver {
    private static final String TAG = "CustomPushReceiver";

    @Override
    public void onReceive(Context context, Intent intent) {
        String action = intent.getAction();
        Log.d(TAG, "action=" + action);
        // Handle Push Message when opened
        if (action.equals(Pushbots.MSG_OPENED)) {
            HashMap<?, ?> PushdataOpen = (HashMap<?, ?>) intent.getExtras().get(Pushbots.MSG_OPEN);
            Log.w(TAG, "User clicked notification with Message: " + PushdataOpen.get("message"));
            // Start activity if not active
            // set the value of local variable "active" in onStart()/onStop() in MainActivity
            // to check for MainActivity status

            if (!Home.isActive()) {
                Intent launch = new Intent(Intent.ACTION_MAIN);
                launch.setClass(Pushbots.getInstance().appContext, Home.class);
                launch.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                Pushbots.getInstance().appContext.startActivity(launch);
            }

            // Handle Push Message when received
        } else if (action.equals(Pushbots.MSG_RECEIVE)) {
            HashMap<?, ?> Pushdata = (HashMap<?, ?>) intent.getExtras().get(Pushbots.MSG_RECEIVE);
            Log.w(TAG, "User Received notification with Message: " + Pushdata.get("message"));
        }

    }

    /*
    @Override
    public void onReceive(Context context, Intent intent) {

        String action = intent.getAction();
        Log.d(TAG, "action=" + action);

        // Handle Push Message when opened
        if (action.equals(Pushbots.MSG_OPENED)) {
            HashMap<String, String> PushdataOpen = (HashMap<String, String>)
                    intent.getExtras().get(Pushbots.MSG_OPEN);
            // Notification Message
            Log.w(TAG, "User clicked notification with Message: " + PushdataOpen.get("message"));
            // Notification custom fields
            Log.w(TAG, "User clicked notification with article ID: " + PushdataOpen.get("articleid"));

            // Handle Push Message when received

        } else if (action.equals(Pushbots.MSG_RECEIVE)) {
            HashMap<String, String> Pushdata = (HashMap<String, String>)
                    intent.getExtras().get(Pushbots.MSG_RECEIVE);
            Log.w(TAG, "User Received notification with Message: " + Pushdata.get("message"));
        }

    }
    */
}
