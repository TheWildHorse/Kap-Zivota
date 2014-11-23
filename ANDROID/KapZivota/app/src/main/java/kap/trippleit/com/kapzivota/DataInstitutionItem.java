package kap.trippleit.com.kapzivota;

/**
 * Created by root on 22.11.14..
 */
public class DataInstitutionItem {

    Integer id;
    String name;
    String description;
    String adresa;
    Double geo_lat;
    Double geo_long;

    public DataInstitutionItem(Integer id, String name, String description, String adresa, Double geo_lat, Double geo_long) {
        this.id = id;
        this.name = name;
        this.description = description;
        this.adresa = adresa;
        this.geo_lat = geo_lat;
        this.geo_long = geo_long;
    }

    public Integer getId() {
        return id;
    }

    public void setId(Integer id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public String getAdresa() {
        return adresa;
    }

    public void setAdresa(String adresa) {
        this.adresa = adresa;
    }

    public Double getGeo_lat() {
        return geo_lat;
    }

    public void setGeo_lat(Double geo_lat) {
        this.geo_lat = geo_lat;
    }

    public Double getGeo_long() {
        return geo_long;
    }

    public void setGeo_long(Double geo_long) {
        this.geo_long = geo_long;
    }
}
