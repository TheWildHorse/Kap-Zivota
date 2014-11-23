package kap.trippleit.com.kapzivota;

import android.app.Activity;
import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.view.WindowManager;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

/**
 * Created by root on 23.11.14..
 */
public class Achivments extends Activity {

    private List<DataAcivmentsItem> acivments = new ArrayList<DataAcivmentsItem>();
    TextView et;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.achivments);
        et = (TextView) findViewById(R.id.tvAchivmentCount);
        new Read().execute();
    }

    private class MyListAdapter extends ArrayAdapter<DataAcivmentsItem> {
        public MyListAdapter() {
            super(Achivments.this, R.layout.institutionlist_item, acivments);
        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            View itemView = convertView;

            if (itemView == null) {
                itemView = getLayoutInflater().inflate(R.layout.institutionlist_item, parent, false);
            }

            //Fiad Institiution
            DataAcivmentsItem currentInstitution = acivments.get(position);

            //Fill the view
            TextView makeTest = (TextView) itemView.findViewById(R.id.tvInstitituinItemName);
            makeTest.setText(currentInstitution.getName());

            TextView makeTest2 = (TextView) itemView.findViewById(R.id.tvInstitituinItemAddress);
            makeTest2.setText("");

            TextView makeTest3 = (TextView) itemView.findViewById(R.id.tvInstitituinItemDistance);
            makeTest3.setText("");


            ImageView iv = (ImageView)itemView.findViewById(R.id.imageView);
            iv.setImageResource(R.drawable.star);

            return itemView;
        }
    }

    class Read extends AsyncTask<String, Integer, String> {

        ProgressDialog dialog;

        protected void onPreExecute() {
            dialog = new ProgressDialog(Achivments.this);
            dialog.setProgressStyle(ProgressDialog.STYLE_HORIZONTAL);
            dialog.setMax(100);
            dialog.show();
        }

        @Override
        protected void onProgressUpdate(Integer... values) {
            super.onProgressUpdate(values);
            dialog.incrementProgressBy(values[0]);
        }

        @Override
        protected String doInBackground(String... params) {
            publishProgress(10);
            try {
                HttpGet get = new HttpGet("http://178.62.168.32/api/statistics/donations/"+Singleton.getUser_id(Achivments.this));
                HttpClient client = new DefaultHttpClient();
                HttpResponse r = client.execute(get);
                int status = r.getStatusLine().getStatusCode();
                if (status == 200) {
                    HttpEntity e = r.getEntity();
                    String data = EntityUtils.toString(e);
                    return data;
                } else {
                    Toast.makeText(Achivments.this, "ERROR", Toast.LENGTH_LONG);
                }
            } catch (IOException e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(String s) {
            try {

                JSONObject root = new JSONObject(s);
                String num = root.getString("number of donations");
                JSONArray jArray = root.getJSONArray("achivement list");
                for (int i = 0; i < jArray.length(); i++) {
                    acivments.add(new DataAcivmentsItem(jArray.getJSONObject(i).getString("name")));
                }

                et.setText(num);
                ArrayAdapter<DataAcivmentsItem> adapter = new MyListAdapter();

                ListView list = (ListView) findViewById(R.id.lvAchivmentLists);
                list.setAdapter(adapter);

                dialog.dismiss();

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }


    }

}
