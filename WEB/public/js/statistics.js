
function fillTopDonors(donorInfo, numDonations) {
    var dataTopDonors = [
        {
            value: numDonations[0],
            color: "#F7464A",
            highlight: "#FF5A5E",
            label: donorInfo[0]
        },
        {
            value: numDonations[1],
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: donorInfo[1]
        },
        {
            value: numDonations[2],
            color: "#FDB45C",
            highlight: "#FFC870",
            label: donorInfo[2]
        },
        {
            value: numDonations[3],
            color: "green",
            highlight: "#66CD00",
            label: donorInfo[3]
        },
        {
            value: numDonations[4],
            color: "yellow",
            highlight: "#ffff66",
            label: donorInfo[4]
        }
    ];
    var ctx = document.getElementById("topDonors").getContext("2d");
    var myNewChart = new Chart(ctx).Pie(dataTopDonors, {responsive: true});
}

function getTopDonors() {
    $.ajax({
        type: "GET",
        url: "api/statistics/users/topten",
        dataType: "json",
        success: function(topTen) {
            var donorInfoArray = Array(
                    topTen[0]["name"] + " " + topTen[0]["surname"],
                    topTen[1]["name"] + " " + topTen[1]["surname"],
                    topTen[2]["name"] + " " + topTen[2]["surname"],
                    topTen[3]["name"] + " " + topTen[3]["surname"],
                    topTen[4]["name"] + " " + topTen[4]["surname"]
                    );
            var numDonationsArray = Array(
                    topTen[0]["broj"],
                    topTen[1]["broj"],
                    topTen[2]["broj"],
                    topTen[3]["broj"],
                    topTen[4]["broj"]
                    );
            fillTopDonors(donorInfoArray, numDonationsArray);
        }
    });
}

function fillTopGroups(bloodGroupsQuantity) {
    var dataTopGroup = {
        labels: ["AB +", "AB -", "A +", "A -", "B +", "B -", "O +", "O -"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(151,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [
                    bloodGroupsQuantity["AB+"],
                    bloodGroupsQuantity["AB-"],
                    bloodGroupsQuantity["A+"],
                    bloodGroupsQuantity["A-"],
                    bloodGroupsQuantity["B+"],
                    bloodGroupsQuantity["B-"],
                    bloodGroupsQuantity["0+"],
                    bloodGroupsQuantity["0-"]
                ]
            }
        ]
    };

    var ctx = document.getElementById("topGroup").getContext("2d");
    var myNewChart = new Chart(ctx).Radar(dataTopGroup, {responsive: true});
}

function getTopGroups() {
    $.ajax({
        type: "GET",
        url: "api/statistics/users/topgroups",
        dataType: "json",
        success: function(topTen) {
            var bloodGroupsQuantity = {
                "0-": 0,
                "0+": 0,
                "A-": 0,
                "A+": 0,
                "B-": 0,
                "B+": 0,
                "AB-": 0,
                "AB+": 0
            };
            for (var i in topTen) {
                var bloodGroup = topTen[i]["type"];
                var bloodQuantity = topTen[i]["broj"];
                bloodGroupsQuantity[bloodGroup] = bloodQuantity;
            }
            fillTopGroups(bloodGroupsQuantity);
        }
    });
}

function fillTopInstitutions(institutionNames, bloodGroupsQuantity) {

    var dataTopInstitutions = [
        {
            value: bloodGroupsQuantity[0],
            color: "#F7464A",
            highlight: "#FF5A5E",
            label: institutionNames[0]
        },
        {
            value: bloodGroupsQuantity[1],
            color: "#46BFBD",
            highlight: "#5AD3D1",
            label: institutionNames[1]
        },
        {
            value: bloodGroupsQuantity[2],
            color: "#FDB45C",
            highlight: "#FFC870",
            label: institutionNames[2]
        },
        {
            value: bloodGroupsQuantity[3],
            color: "green",
            highlight: "#66CD00",
            label: institutionNames[3]
        },
        {
            value: bloodGroupsQuantity[4],
            color: "Yellow",
            highlight: "#ffff66",
            label: institutionNames[5]
        }
    ];

    var ctx = document.getElementById("institutionStatistic").getContext("2d");
    var myNewChart = new Chart(ctx).PolarArea(dataTopInstitutions, {responsive: true});
}

function getTopInstitutions() {
    $.ajax({
        type: "GET",
        url: "api/statistics/users/topinstitutionsdonations",
        dataType: "json",
        success: function(topTen) {
            var institutionNames = Array(
                    topTen[0]["name"],
                    topTen[1]["name"],
                    topTen[2]["name"],
                    topTen[3]["name"],
                    topTen[4]["name"]
                    );
            var bloodGroupsQuantity = Array(
                    topTen[0]["broj"],
                    topTen[1]["broj"],
                    topTen[2]["broj"],
                    topTen[3]["broj"],
                    topTen[4]["broj"]
                    );
            fillTopInstitutions(institutionNames, bloodGroupsQuantity);
        }
    });
}

getTopDonors();
getTopGroups();
getTopInstitutions();