
getBloodLevelGroups();

setInterval(function() {
    getBloodLevelGroups();
}, 15000);

var groupsLoaded = 0;

function getBloodLevelGroups() {
    $.ajax({
        type: "GET",
        url: "api/statistics/institutions/{{ Auth::user()->institution_id }}/bloodlevels",
        dataType: "json",
        success: function(criticalLevel) {
            $.ajax({
                type: "GET",
                url: "api/statistics/institutions/{{ Auth::user()->institution_id }}/bloodgrouplevels",
                dataType: "json",
                success: function(dataArray) {
                    criticalLevel = criticalLevel["criticalLevel"];
                    var criticalLevelArray = {
                        "0-": criticalLevel,
                        "0+": criticalLevel,
                        "A-": criticalLevel,
                        "A+": criticalLevel,
                        "B-": criticalLevel,
                        "B+": criticalLevel,
                        "AB-": criticalLevel,
                        "AB+": criticalLevel
                    };
                    var bloodGroupsQuantity = {
                        "AB+": 0,
                        "AB-": 0,
                        "A+": 0,
                        "A-": 0,
                        "B+": 0,
                        "B-": 0,
                        "0+": 0,
                        "0-": 0,
                        "Critical level":criticalLevel
                    };
                    for (var i in dataArray) {
                        var bloodGroup = dataArray[i]["blood_id"];
                        var bloodQuantity = dataArray[i]["quantity"];
                        bloodGroupsQuantity[bloodGroup] = bloodQuantity;
                    }
                    fillChart(bloodGroupsQuantity, criticalLevelArray);
                }
            });
        }
    });
}

function fillChart(bloodGroupsQuantity, criticalLevel) {
    var data = {
        labels: ["AB +", "AB -", "A +", "A -", "B +", "B -", "O +", "O -", "Kritična razina"],
        datasets: [
            {
                label: "My Second dataset",
                fillColor: "rgba(215, 44, 44, 0.7)",
                strokeColor: "rgba(215, 44, 44, 0.8)",
                highlightFill: "rgba(57, 61, 55, 0.7)",
                highlightStroke: "rgba(57, 61, 55, 1)",
                data: bloodGroupsQuantity
            }
        ]
    };
    var ctx = document.getElementById("myChart").getContext("2d");
    var myNewChart = new Chart(ctx).Bar(data, {responsive: true});
}

$('#btnOrder').click(function() {
    $('#form').toggle('slow');
    $("html, body").animate({scrollTop: 250}, "slow");
});