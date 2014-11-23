package kap.trippleit.com.kapzivota;

import android.content.Context;
import android.content.SharedPreferences;

import java.util.Calendar;
import java.util.Date;
import java.util.GregorianCalendar;

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

    public static String getLanguage(Context c) {
        return get(c, "language");
    }

    public static void setLanguage(Context c, String VAL) {
        set(c, "language", VAL);
    }

    public static float getAge(final Date current, final Date birthdate) {

        if (birthdate == null) {
            return 0;
        }
        if (current == null) {
            return getAge(birthdate);
        } else {
            final Calendar calend = new GregorianCalendar();
            calend.set(Calendar.HOUR_OF_DAY, 0);
            calend.set(Calendar.MINUTE, 0);
            calend.set(Calendar.SECOND, 0);
            calend.set(Calendar.MILLISECOND, 0);

            calend.setTimeInMillis(current.getTime() - birthdate.getTime());

            float result = 0;
            result = calend.get(Calendar.YEAR) - 1970;
            result += (float) calend.get(Calendar.MONTH) / (float) 12;
            return result;
        }

    }

    public static float getAge(final Date birthdate) {
        return getAge(Calendar.getInstance().getTime(), birthdate);
    }

}
