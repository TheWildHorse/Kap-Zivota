package kap.trippleit.com.kapzivota;

/**
 * Created by root on 22.11.14..
 */
public class DataUserDonationsItem {

    String hospitalName;
    Integer count;

    public DataUserDonationsItem(String hospitalName, Integer count) {
        this.hospitalName = hospitalName;
        this.count = count;
    }

    public String getHospitalName() {
        return hospitalName;
    }

    public void setHospitalName(String hospitalName) {
        this.hospitalName = hospitalName;
    }

    public Integer getCount() {
        return count;
    }

    public void setCount(Integer count) {
        this.count = count;
    }
}
