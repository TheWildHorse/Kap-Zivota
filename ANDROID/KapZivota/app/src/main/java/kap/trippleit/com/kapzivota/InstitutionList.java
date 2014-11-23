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

public class InstitutionList extends Activity {

    private List<DataInstitutionItem> institutions = new ArrayList<DataInstitutionItem>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.institutionlist);

        new Read().execute();
    }

    public void renderList() {
        ArrayAdapter<DataInstitutionItem> adapter = new MyListAdapter();
        ListView list = (ListView) findViewById(R.id.lvInstitutionList);
        list.setAdapter(adapter);
    }

    public class Read extends AsyncTask<String, Integer, String> {

        ProgressDialog dialog;

        protected void onPreExecute() {
            dialog = new ProgressDialog(InstitutionList.this);
            dialog.setProgressStyle(ProgressDialog.STYLE_HORIZONTAL);
            dialog.setMax(100);
            dialog.show();
        }

        @Override
        protected String doInBackground(String... params) {
            publishProgress(10);
            try {
                HttpGet get = new HttpGet("http://178.62.168.32/api/institutions");
                HttpClient client = new DefaultHttpClient();
                HttpResponse r = client.execute(get);
                int status = r.getStatusLine().getStatusCode();
                if (status == 200) {
                    HttpEntity e = r.getEntity();
                    String data = EntityUtils.toString(e);
                    return data;
                } else {
                    Toast.makeText(InstitutionList.this, "ERROR", Toast.LENGTH_LONG);
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
                JSONArray jArray = root.getJSONArray("institutions");

                for (int i = 0; i < jArray.length(); i++) {
                    publishProgress((i * 100) % 100);
                    Integer id = Integer.parseInt(jArray.getJSONObject(i).getString("id"));
                    String name = jArray.getJSONObject(i).getString("name");
                    String description = jArray.getJSONObject(i).getString("description");
                    String adresa = "";
                    Double x = Double.parseDouble(jArray.getJSONObject(i).getString("geo_lat"));
                    Double y = Double.parseDouble(jArray.getJSONObject(i).getString("geo_long"));
                    institutions.add(new DataInstitutionItem(id, name, description, adresa, x, y));
                }

                renderList();
                dialog.dismiss();

            } catch (JSONException e) {
                e.printStackTrace();
            }
        }

        @Override
        protected void onProgressUpdate(Integer... values) {
            super.onProgressUpdate(values);
            dialog.incrementProgressBy(values[0]);
        }

    }

    private class MyListAdapter extends ArrayAdapter<DataInstitutionItem> {
        public MyListAdapter() {
            super(InstitutionList.this, R.layout.institutionlist_item, institutions);
        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            View itemView = convertView;

            if (itemView == null) {
                itemView = getLayoutInflater().inflate(R.layout.institutionlist_item, parent, false);
            }

            //Fiad Institiution
            DataInstitutionItem currentInstitution = institutions.get(position);

            //Fill the view
            TextView makeTest = (TextView) itemView.findViewById(R.id.tvInstitituinItemName);
            makeTest.setText(currentInstitution.getName());

            TextView makeTest1 = (TextView) itemView.findViewById(R.id.tvInstitituinItemDistance);
            makeTest1.setText(currentInstitution.getAdresa());

            TextView makeTest2 = (TextView) itemView.findViewById(R.id.tvInstitituinItemAddress);
            makeTest2.setText(currentInstitution.getDescription());

            return itemView;
        }
    }
}
