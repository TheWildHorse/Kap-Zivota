package kap.trippleit.com.kapzivota;

import android.app.Activity;
import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.view.WindowManager;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Iterator;
import java.util.List;

public class ViewDonations extends Activity {

    TextView tvViewdonationsCount;
    private List<DataUserDonationsItem> institutions = new ArrayList<DataUserDonationsItem>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.viewdonations);

        tvViewdonationsCount = (TextView) findViewById(R.id.tvViewdonationsCount);

        new Read().execute();
        new ReadDonations().execute();

    }

    public class Read extends AsyncTask<String, Integer, String> {

        ProgressDialog dialog;

        protected void onPreExecute() {
            dialog = new ProgressDialog(ViewDonations.this);
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
            try {
                HttpGet get = new HttpGet("http://178.62.168.32/api/donations/users/" + Singleton.getUser_id(ViewDonations.this) + "/count");
                HttpClient client = new DefaultHttpClient();
                HttpResponse r = client.execute(get);
                int status = r.getStatusLine().getStatusCode();
                if (status == 200) {
                    HttpEntity e = r.getEntity();
                    String data = EntityUtils.toString(e);
                    return data;
                } else {
                    Toast.makeText(ViewDonations.this, "ERROR", Toast.LENGTH_LONG);
                }

            } catch (IOException e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(String s) {
            tvViewdonationsCount.setText(s);
            dialog.dismiss();
        }
    }

    public void renderList() {
        ArrayAdapter<DataUserDonationsItem> adapter = new MyListAdapter();
        ListView list = (ListView) findViewById(R.id.lvViewdonationsList);
        list.setAdapter(adapter);
    }


    class ReadDonations extends AsyncTask<String, Integer, String> {

        @Override
        protected String doInBackground(String... params) {
            publishProgress(10);
            try {
                HttpGet get = new HttpGet("http://178.62.168.32/api/donations/users/" + Singleton.getUser_id(ViewDonations.this));
                Log.d("KRUNO", "url: " + "http://178.62.168.32/api/donations/users/" + Singleton.getUser_id(ViewDonations.this));
                HttpClient client = new DefaultHttpClient();
                HttpResponse r = client.execute(get);
                int status = r.getStatusLine().getStatusCode();
                if (status == 200) {
                    HttpEntity e = r.getEntity();
                    String data = EntityUtils.toString(e);
                    return data;
                } else {
                    Toast.makeText(ViewDonations.this, "ERROR", Toast.LENGTH_LONG);
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


                JSONObject jsonObject = root;

                for (Iterator iterator = jsonObject.keys(); iterator.hasNext(); ) {
                    String key = (String) iterator.next();
                    System.out.println(jsonObject.get(key));
                    institutions.add(new DataUserDonationsItem(key, Integer.parseInt(jsonObject.get(key).toString())));
                }

                renderList();

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }


    }

    private class MyListAdapter extends ArrayAdapter<DataUserDonationsItem> {
        public MyListAdapter() {
            super(ViewDonations.this, R.layout.institutionlist_item, institutions);
        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            View itemView = convertView;

            if (itemView == null) {
                itemView = getLayoutInflater().inflate(R.layout.institutionlist_item, parent, false);
            }

            //Fiad Institiution
            DataUserDonationsItem currentInstitution = institutions.get(position);

            //Fill the view
            TextView makeTest = (TextView) itemView.findViewById(R.id.tvInstitituinItemName);
            makeTest.setText(currentInstitution.getHospitalName());

            TextView makeTest2 = (TextView) itemView.findViewById(R.id.tvInstitituinItemDistance);
            makeTest2.setText("" + currentInstitution.getCount());

            TextView makeTest3 = (TextView) itemView.findViewById(R.id.tvInstitituinItemAddress);
            makeTest3.setText("");

            return itemView;
        }
    }

}
