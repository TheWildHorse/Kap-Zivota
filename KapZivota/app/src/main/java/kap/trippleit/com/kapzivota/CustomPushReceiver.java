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
}
