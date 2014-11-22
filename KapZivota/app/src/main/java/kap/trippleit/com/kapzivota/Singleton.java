package kap.trippleit.com.kapzivota;

import android.content.Context;
import android.content.SharedPreferences;

/**
 * Created by root on 22.11.14..
 */
public class Singleton {

    public static String STORE = "MySharedString";

    private static String get(Context c, String KEY) {
        SharedPreferences LOCALDATA = c.getSharedPreferences(STORE, 0);
        return LOCALDATA.getString(KEY, "");
    }

    private static void set(Context c, String KEY, String VAL) {
        SharedPreferences LOCALDATA = c.getSharedPreferences(STORE, 0);
        SharedPreferences.Editor editor = LOCALDATA.edit();
        editor.putString(KEY, VAL);
        editor.commit();
    }

    public static String getApi_key(Context c) {
        return get(c, "api_key");
    }

    public static void setApi_key(Context c, String VAL) {
        set(c, "api_key", VAL);
    }

    public static String getUser_id(Context c) {
        return get(c, "user_id");
    }

    public static void setUser_id(Context c, String VAL) {
        set(c, "user_id", VAL);
    }


}
