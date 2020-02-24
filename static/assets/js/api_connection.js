
var response_data;
var url;
var developerToken;

// CMS server IP address
// url = "https://motor.nictanzania.co.tz/";
url = "http://192.168.43.86:8000";

// developerToken to access NIC APIs
developerToken = "KZ3O5ONX0UZDRV7217LDGSWOXYK6SYLG";

class Connect {
    
    constructor() {
        var ip_address = url + "website_endpoint/";
        $.ajax({
            url: ip_address,
            method: "GET",
            data: {
                "token": developerToken,
            },
            async: false,
            success: function (response) {
                if (response.status) {
                    response_data = response;
                    console.log('Connection successfull!');
                } else {
                    console.log('Access Denied ' + response.message);
                }
            }
        });
    }
    
    filter_data_form(params) {
        return response_data[params];
    }

    
}

class Connect_2 {
    constructor(news_id = 0, email_address) {
        // let ip_address = url + "nic_website/emailApi/";
        let ip_address = url + "emailApi/?token="+developerToken;
        // $.get(ip_address,{"token":developerToken,"id":news_id,"email":email_address}).done(function(response){
        //     if (response.status) {
        //         console.log('Connection successfull!');
        //     } else {
        //         console.log('Access Denied ' + response.message);
        //     }
        // });
        $.ajax({
            url: ip_address,
            method: "POST",
            data: {
                "id": news_id,
                "email": email_address,
            },
            async: false,
            success: function (response) {
                if (response.status) {
                    console.log('Connection successfull!');
                } else {
                    console.log('Access Denied ' + response.message);
                }
            }
        });
    }
}

// new Connect_2();
