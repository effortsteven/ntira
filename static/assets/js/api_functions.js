
connection = new Connect();

var ip_address, defaultImage, defaultNewsImage;
    ip_address = url;

    //default image of news it fails to find from API
    defaultNewsImage = "no_img.png"

    //default image of insurance if it fails to find image from API
    defaultImage = 'product_2.jpg';

//get news feeds
function news_feeds() {
    var response = connection.filter_data_form("news_feeds");
    var news_list = [];
    if (response.length > 0) {
        $.each(response, function (index, value) {
            let url, news;
            url = "'" + value['link'] + "'";
            news = `<div class='col-lg-12 feeds_div'> 
                            <div class=' col-lg-9 col-md-12 col-sm-12 btn-info news_dates' >
                                    <div class='col-news-date' style="display:inline-block">`
                                     + value.date + value.end_date + `
                                    </div>
                                    <div class='new_news'>
                                    New
                                    </div>
                            </div>
                            <div class=' col-lg-12 news-cont' >
                            ` + value.description.slice(0,50) +`
                            ....<span style="cursor: pointer;" onClick="open_pager(`+value.id+`)" class="text-info">Read more</span>
                            </div>
                        </div >`;
            news_list.push(news);
        });
    } else {
        news_list.push("<div class='col-lg-12 text-center'><h5 class='text-warning' style='box-shadow:2px 2px 3px 3px rgba(0,0,0,.1); border-radius:6px; padding:5px;'> No news!</h5></div>");
    }
    return news_list;
}

//get tenders 
function tenders() {
    var response = connection.filter_data_form("tenderlist");
    var tender_list = [];
    var tender_modal_list = [];
    if (response.length > 0) {
        $.each(response, function (index, value) {
            var tender_number = value['tender_number'];
            var tender_description = value['tender_description'];
            var tender_category = value['tender_category'];
            var bid_document_price = value['bid_document_price'];
            var tender_id = value['tender_id'];
            var deadline = value['deadline'];
            var eligible_firm = value['eligible_firm'];
            var file_name = value['file_name'];
            file_name = file_name;
            var method_of_procurement = value['method_of_procurement'];
            var tender = `<tr>
            <td class="text-center mob-hide-col">1</td>
            <td class="mob-hide-col">`+ tender_number + `</td>
            <td style=" width: 300px">`+ tender_description + `</td>
            <td class="mob-hide-col">`+ tender_category + `</td>
            <td class="mob-hide-col">`+ bid_document_price + `</td>
            <td class="text-right">`+ deadline + `</td>
            <td class="td-actions text-right">
                <button type="button more-info" rel="tooltip" class="btn btn-info" data-toggle="modal" data-target="#tender-`+ tender_id + `">
                    More Details
                </button>
            </td>
        </tr>`;
            var tender_modal = `
        <div class="modal fade bd-example-modal-lg" id="tender-`+ tender_id + `" tabindex="-1" role="dialog" aria-labelledby="moreTenderDetails" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header ">
              <h5 class="modal-title" id="moreTenderDetails" >TENDER NUMBER: <span class=" modal_badge">`+ tender_number + `</span></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" style="color: red">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="font-size: 13px;">
                  <div class="row">
                      <div class="col-lg-3 col-xs-3 font-weight-bold">
                          Procuring Entity - Code Number
                      </div>
                      <div class="col-lg-9 col-xs-9">
                          `+ tender_number + `
                      </div>
                  </div>

                  <hr>

                  <div class="row">
                      <div class="col-lg-3 col-xs-3 font-weight-bold">
                          Tender Number - Tender Category
                      </div>
                      <div class="col-lg-9 col-xs-9">
                          `+ tender_category + `
                      </div>
                  </div>

                  <hr>

                  <div class="row">
                      <div class="col-lg-3 col-xs-3 font-weight-bold">
                          Tender Description
                      </div>
                      <div class="col-lg-9 col-xs-9">
                          `+ tender_description + `
                      </div>
                  </div>

                  <hr>

                  <div class="row">
                      <div class="col-lg-3 col-xs-3 font-weight-bold">
                          Eligible Firms
                      </div>
                      <div class="col-lg-9 col-xs-9">
                          `+ eligible_firm + `
                      </div>
                  </div>

                  <hr>

                  <div class="row">
                      <div class="col-lg-3 col-xs-3 font-weight-bold">
                          Method of Procurement
                      </div>
                      <div class="col-lg-9 col-xs-9">
                          `+ method_of_procurement + `
                      </div>
                  </div>

                  <hr>

                  <div class="row">
                      <div class="col-lg-3 col-xs-3 font-weight-bold">
                          Deadline
                      </div>
                      <div class="col-lg-9 col-xs-9">
                          `+ deadline + `
                      </div>
                  </div>
            </div>
            <div class="modal-footer">
              <a href="`+ file_name + `" class="btn btn-success btn-round sys-btn-raise btn-sm"><i class="icon-download4"></i>&nbsp&nbspDownload</a>
              <button type="button" class="btn btn-danger ml-2 btn-round sys-btn-raise btn-sm" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
            </div>
          </div>
        </div>
      </div>
        `;
            tender_list.push(tender);
            tender_modal_list.push(tender_modal);
        });
        $(".tender_modal").html(tender_modal_list);
    } else {
        tender_list = [];
        $('.table-tenders').css('display','none');
        $('#tenders').html(`<div class="custom-danger-alert alert-animated"><span><i class="icon-alert"></i> &nbsp&nbsp Currently no new Tenders !</span></div>`);
    }
    return tender_list;
}

//get job data
function careers() {
    var response = connection.filter_data_form("careerlist");
    var job_objectives_list_response = connection.filter_data_form("job_objectives_list");
    var qualification_list_response = connection.filter_data_form("qualification_list");
    var careers_list = [];
    var careers_list_mobile = [];
    var careers_modals_list = [];
    var qualification_list = [];
    var job_objectives_list = [];

    if (response.length > 0) {
        $.each(response, function (index, value) {
            var job_title = value['job_title'];
            var position = value['position'];
            var year = value['year'];
            var career_id = value['career_id'];
            $.each(job_objectives_list_response, function (index, value) {
                if (job_title == value['job_title']) {
                    job_objectives_list.push('<li>' + value['description'] + '</li>');
                }
            });
            $.each(qualification_list_response, function (index, value) {
                if (job_title == value['job_title']) {
                    qualification_list.push('<li>' + value['qualification'] + '</li>');
                }
            });
            var career = `
            <div class="row">
                <div class="col-lg-2 col-sm-2">
                    `+ index + 1 + `
                </div>
                <div class="col-lg-6 col-sm-2">
                    `+ job_title + `
                </div>
                <div class="col-lg-2 col-sm-2">
                    `+ position + `
                </div>
                <div class="col-lg-2 col-sm-2">
                    <button type="button more-info" class="btn btn-info btn-sm" data-toggle="modal" data-target="#job-`+ career_id + `">
                        More Details
                    </button>
                </div>
            </div>
            `;
            var career_modal = `
            <div class="modal fade bd-example-modal-lg" id="job-`+ career_id + `" tabindex="-1" role="dialog" aria-labelledby="moreTenderDetails" aria-hidden="true" >
            <div class="modal-dialog modal-lg" role="document" >
              <div class="modal-content b-r-6" style=" z-index: 1000;">

                  <div class="top-div  b-r-6">

                      <div class="col-lg-12 col-xs-12 font-weight-bold">
                          <h5>`+ job_title + `</h5>
                      </div>

                      <div class="col-lg-12 text-left">
                          <h6 style="text-transform: none;">Job Objectives:</h6>
                          <ul>
                             `+ job_objectives_list + `
                          </ul>
                      </div>

                      <div class="col-lg-12 text-left">
                          <h6 style="text-transform: none;">Qualifications and Experience:</h6>
                          <ul>
                          `+ qualification_list + `
                          </ul>

                      </div>
                      <div class="text-right mb-3 mr-2">

                          <button type="button" class="btn btn-danger ml-2 btn-round sys-btn-raise btn-sm" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
                          <a href="`+value.file_name+`" target="_blank" class="btn btn-info btn-sm btn-round sys-btn-raise" download>
                              <i class="icon-download4"></i> Download PDF
                          </a>
                          <button id="apply_form" type="button more-info" class="btn btn-success btn-sm btn-round sys-btn-raise">
                              <i class="icon-checkmark2"></i> Apply Job
                          </button>

                      </div>
                  </div>
              <!-- end of top div -->


                  <div class="bottom-div  b-r-6 text-center">
                      <h5 class="font-weight-bold">APPLICANTION FORM</h5>
                    <form action="" class="application_form" method="POST">
                    <input type="hidden" name="career" value="`+ career_id + `"/>
                    <div class="row">
                    <div class="col">
                      <div class="form-group text-left">
                         <label for="exampleInput1" class="bmd-label-floating ">Enter Full Names<span class="text-danger">*</span></label>
                         <input type="text" name="full_name" class="form-control">
                         <span class="bmd-help">Names should match as in your Academic Certificates.</span>
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                      <div class="form-group text-left">
                         <label for="exampleInput1" class="label-control">Date of Birth<span class="text-danger">*</span></label>
                         <input type="text" name="dob" class="form-control birthday" value=""/>
                         <span class="bmd-help">Dates should match as in your Academic Certificates.</span>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group text-left">
                         <label for="exampleInput1" class="bmd-label-floating ">Postal Address<span class="text-danger">*</span></label>
                         <input type="text" name="postal_address" class="form-control">
                         <!-- <span class="bmd-help">Names should match as in your Academic Certificates.</span> -->
                      </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                      <div class="form-group text-left">
                         <label for="exampleInput1" class="bmd-label-floating ">Place of Birth<span class="text-danger">*</span></label>
                         <input type="text" name="place_of_birth" class="form-control">
                         <span class="bmd-help">This data should match as in your Academic Certificates.</span>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group text-left">
                         <label for="exampleInput1" class="bmd-label-floating ">Nationality<span class="text-danger">*</span></label>
                        <select name="nationality" class="form-control select-arry">
                        </select>
                      </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col">
                      <div class="form-group text-left">
                         <label for="exampleInput1" class=" ">Marital Status<span class="text-danger">*</span></label>

                         <div>

                         <div class="form-check form-check-radio form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="marital_status" value="1">
                             Single
                            <span class="circle">
                                <span class="check" ></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-radio form-check-inline">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="marital_status" value="2">
                            Married
                            <span class="circle">
                                <span class="check"></span>
                            </span>
                          </label>
                        </div>
                        <div class="form-check form-check-radio form-check-inline disabled">
                          <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="marital_status" value="3">
                            Widowed
                            <span class="circle">
                                <span class="check"></span>
                            </span>
                          </label>
                        </div>
                         </div>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group text-left">
                         <label for="exampleInput1" class="bmd-label-floating ">Telephone No.<span class="text-danger">*</span></label>
                         <input type="text" name="phone" class="form-control">
                         <span class="bmd-help">Use Number which is available at all times.</span>
                      </div>
                    </div>
                </div>
                <hr>

                                    <div class="row">

                                        <label class="col-md-12 mt-2">Educational and Professional Qualifications</label>

                                       <div id="edu_div" class="col-md-12">
                                           <div class="row edu_div">
                                               <input type="hidden" name="education_type" value="1"/>
                                                <div class="col-md-3">
                                                    <div class="form-group text-left">
                                                         <label for="exampleInput1" class="bmd-label-floating ">Name of school<span class="text-danger">*</span></label>
                                                         <input type="text" name="name_of_school" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group text-left">
                                                         <label for="exampleInput1" class="bmd-label-floating ">Finish Year<span class="text-danger">*</span></label>
                                                         <input type="text" name="school_finish_year" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-5">
                                                   <div class="form-group text-left">
                                                         <label for="exampleInput1" class="bmd-label-floating ">Examinations passed<span class="text-danger">*</span></label>
                                                         <input type="text" name="exam_passed" class="form-control">
                                                        <span class="bmd-help">Eg. (Math, Kiswahil, Civics....)</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                   <div class="form-group text-left">
                                                         <label for="exampleInput1" class="bmd-label-floating ">Division/Grade<span class="text-danger">*</span></label>
                                                         <input type="text" name="pass_by" class="form-control">
                                                    </div>
                                                </div>
                                           </div>
                                       </div>

                                        <div class="col-md-2">

                                            <button id="edu_btn" class="btn btn-round btn-sm sys-btn-raise btn-info"><i class="icon-plus22" style="font-size: 20px;"></i> Add Row</button>

                                        </div>

                                    </div>


                                    <div class="row">

                                        <label class="col-md-12 mt-2">Details of Technical and University education and professional qualifications obtained since leaving school</label>

                                        <div class="col-md-12" id="uni_div">
                                            <div class="row uni_div">
                                                <div class="col-md-3">
                                                    <div class="form-group text-left">
                                                         <label for="exampleInput1" class="bmd-label-floating ">University/ Techinical College<span class="text-danger">*</span></label>
                                                         <input type="text" name="name_of_school" class="name_of_school form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group text-left">
                                                         <label for="exampleInput1" class="bmd-label-floating ">Finish Year<span class="text-danger">*</span></label>
                                                         <input type="text" name="school_finish_year" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group text-left">
                                                         <label for="exampleInput1" class="bmd-label-floating ">Course<span class="text-danger">*</span></label>
                                                         <input type="text" name="exam_passed" class="form-control">
                                                        <span class="bmd-help">Eg. (Masters, Bachelor, Diploma, or Certificate of.....)</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                   <div class="form-group text-left">
                                                         <label for="exampleInput1" class="bmd-label-floating ">Achieved pass class<span class="text-danger">*</span></label>
                                                         <input type="text" name="pass_by" class="form-control">
                                                        <span class="bmd-help">Eg. (GPA 2.5 Second Class [Lower Division]...)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">

                                            <button id="uni_btn" href="" class="btn btn-round btn-sm sys-btn-raise btn-info"><i class="icon-plus22" style="font-size: 20px;"></i> Add Row</button>

                                        </div>

                                    </div>

                <div class="col-md-10 mb-3">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Other Professional Qualifications achieved</label>
                        <textarea class="form-control" name="others" rows="3"></textarea>
                  </div>
                </div>
                <div class="text-right mb-3 mr-2">
                    <span id="cancel_form" class="btn btn-round btn-sm sys-btn-raise btn-danger"><i class="icon-cross" style="font-size: 20px; cursor: pointer; color: white"></i>Cancel</span>
                    <span id="send_form" class="btn btn-round btn-sm sys-btn-raise btn-success"><i class="icon-checkmark2" style="font-size: 20px; cursor: pointer; color: white"></i> Send</span>

                </div>
                    </form>
                  </div>

              </div>
            </div>
          </div>
            `;
            var career_mobile = `
            <h4 class="" style="font-weight: 600;margin-bottom: 0">`+ job_title + `</h4>
            <label style="">Positions :`+ position + `</label>
            <p style="height: 70px; overflow-y: hidden;">
                Job objectives<br>
            `+ job_objectives_list + `
            </p>
            <button class="btn btn-white sys-btn-raise btn-sm" data-toggle="modal" data-target="#job-`+ career_id + `" style="color: rgba(5, 120, 85,1)">More details</button>
            <button onclick="share()" class="share btn btn-fab btn-round btn-sm sys-btn-raise" title="Share this link" data-toggle="tooltip" data-placement="bottom" style="background: #00a78e">
                <i class="material-icons">share</i>
            </button>
            `;
            careers_list_mobile.push(career_mobile);
            careers_list.push(career);
            careers_modals_list.push(career_modal);
        });
        $(".career_modal").html(careers_modals_list);
        $(".job-div-mob").html(careers_list_mobile);
    } else {
        careers_list = [];
        $('.job-div').css('display','none');
        $('#carrier').html(`<div class="custom-danger-alert alert-animated"><span><i class="icon-alert"></i> &nbsp&nbsp Currently no new job vacancy !</span></div>`);
    }
    return careers_list;
}

//get images slide show for index.html
function home_slideshow() {
    var response = connection.filter_data_form("gallery");
    var slideshow_list = [];
    var data_list = [];
    var new_data_list_ads = [];
    var new_data_list = [];
    var image_lists = [];
    var image_lists_new = [];
    if (response.length > 0) {
        $.each(response, function (index, value) {
            var title = value['title'];
            var description = value['description'];
            var photo_list = value['photo_list'];
            $.each(photo_list, function (index, value) {
                var images = value['photo'];
                if (value['ads']) {
                    new_data_list_ads.push({ "title": title, "images": images });
                } else {
                    new_data_list.push({ "title": title, "images": images });
                }
            });
        });
        $.each(new_data_list_ads, function (index, value) {
            if (index < 5) {
                var item = new_data_list_ads[index];
                image_lists_new.push(item);
            }
        });
        $.each(new_data_list, function (index, value) {
            if (index < 5) {
                var item = new_data_list[Math.floor(Math.random() * new_data_list.length)];
                image_lists_new.push(item);
            }
        });
        $.each(image_lists_new, function (index, value) {
            data_list.push("<li data-target='#carouselExampleIndicators' data-slide-to='" + index + "'></li>");
            if (index == 0) {
                slideshow_list.push("<div class='carousel-item active'><img class='d-block w-100 b-r-7' src='" + value['images'] + "' alt='First slide'><div class='carousel-caption d-none d-md-block'><p class='img-caption'>" + value['title'] + "</p></div></div>");
            } else {
                slideshow_list.push("<div class='carousel-item'><img class='d-block w-100 b-r-7' src='" + value['images'] + "' alt='First slide'><div class='carousel-caption d-none d-md-block'><p class='img-caption'>" + value['title'] + "</p></div></div>");
            }
        });
        $(".data_slide").html(data_list.slice(0, 10));
    } else {
        slideshow_list = [];
    }
    return slideshow_list;
}

// queries all news and events from the end point
function news_events() {
    var response = connection.filter_data_form("news_feeds");
    var news_events = [];

    if (response.length > 0) {
        $.each(response, function (index, value) {
            var date, news_type, news_id, description, end_date, title, download_link, image, image_raw, page_url, download_btn;
            date = value['date'];
            news_type = value['news_type'];
            description = value['description'];
            end_date = value['end_date'];
            title = value['title'];
            news_id = value['id'];
            download_link = value['file_name'];
            page_url = "'" + value['link'] + "'";
            image_raw = value['image'];

            if (image_raw.length != 0) {
                image = image_raw;
            } else {
                image = "../assets/img/kit/"+defaultNewsImage;
                
            }
            if (download_link.length != 0){
                download_btn = '<a href="' + download_link + '" download class="btn btn-fab btn-round btn-sm sys-btn-raise" title="Download File" data-toggle="tooltip" data-placement="bottom" style="background: #6a737b"><i class="material-icons">get_app</i></a>'
            }else{
                download_btn = '';
            }

            if (news_type == 1) {
                news_events.push('<div class="news-div col-md-12 mt-3 mb-3 news"><div class="row"><div class="col-md-5" style=" padding: 0px 0px;">' +
                    '<img class="news-img" src="' + image + '" >' +
                    '</div><div class="col-md-7" style="padding: 0px 0px">' +
                    '<!-- news title -->' +
                    '<h5 style="">' +
                    title +
                    '</h5>' +
                    '<div class="col-md-12 mt-2" style="">' +
                    '<!-- news body -->' +
                    '<p class="pb-5">' +
                    description +
                    '</p></div>' +
                    '<div class="col-md-12 mt-3 mb-3" style="position: absolute; bottom: 0px; width: 100%; ">' +
                    '<!-- provide a news url -->' +
                    '<button onclick="open_pager(' + page_url + ',' + news_id + ')" class="btn btn-fab btn-round btn-sm sys-btn-raise" title="Visit page" data-toggle="tooltip" data-placement="bottom" style="background: #037ef3"><i class="material-icons">open_in_new</i>' +
                    '</button><button onclick="share(' + news_id + ')" class="share btn btn-fab btn-round btn-sm sys-btn-raise" title="Copy this link" data-toggle="tooltip" data-placement="bottom" style="background: #00a78e"><i class="material-icons">share</i></button>' +
                    '<button onclick="send_mail(' + news_id + ')" class="btn btn-fab btn-round btn-rose btn-sm sys-btn-raise" title="Recieve as mail" data-toggle="tooltip" data-placement="bottom"><i class="material-icons">email</i></button>' + download_btn +'</div></div></div></div>');
            } else if (news_type == 2) {
                news_events.push('<div class="news-div col-md-12 mt-3 mb-3 events"><div class="row"><div class="col-md-5" style=" padding: 0px 0px;">' +
                    '<img class="news-img" src="' + image + '" >' +
                    '</div><div class="col-md-7" style="padding: 0px 0px">' +
                    '<!-- news title -->' +
                    '<h5 style="">' +
                    title +
                    '</h5>' +
                    '<div class="col-md-12 mt-2" style="">' +
                    '<!-- news body -->' +
                    '<p class="pb-5">' +
                    description +
                    '</p></div>' +
                    '<div class="col-md-12 mt-3 mb-3" style="position: absolute; bottom: 0px; width: 100%; ">' +
                    '<!-- provide a news url -->' +
                    '<button onclick="open_pager(' + page_url + ',' + news_id + ')" class="btn btn-fab btn-round btn-sm sys-btn-raise" title="Visit page" data-toggle="tooltip" data-placement="bottom" style="background: #037ef3"><i class="material-icons">open_in_new</i>' +
                    '</button><button onclick="share(' + news_id + ')" class="share btn btn-fab btn-round btn-sm sys-btn-raise" title="Copy this link" data-toggle="tooltip" data-placement="bottom" style="background: #00a78e"><i class="material-icons">share</i></button>' +
                    '<button onclick="send_mail(' + news_id + ')" class="btn btn-fab btn-round btn-rose btn-sm sys-btn-raise" title="Recieve as mail" data-toggle="tooltip" data-placement="bottom"><i class="material-icons">email</i></button>' + download_btn +'</div></div></div></div>');
            }
        });
    } else {
        news_events = [];
    }

    return news_events;
}


//queries only the specific news or ovent

function get_news_events(url_id) {

    var response = connection.filter_data_form("news_feeds");
    var news_events = [];

    if (response.length > 0) {
        $.each(response, function (index, value) {
            var date, news_type, news_id, description, end_date, title, download_link, image, image_raw, page_url;
            date = value['date'];
            news_type = value['news_type'];
            description = value['description'];
            end_date = value['end_date'];
            title = value['title'];
            news_id = value['id'];
            download_link  = value['file_name'];
            page_url = "'" + value['link'] + "'";
            image_raw = value['image'];

            if (image_raw.length != 0) {
                image = image_raw;
            } else {
                image = "../assets/img/kit/"+defaultNewsImage;
            }
            if (download_link.length != 0){
                download_btn = '<a href="' + download_link + '" download class="btn btn-fab btn-round btn-sm sys-btn-raise" title="Download File" data-toggle="tooltip" data-placement="bottom" style="background: #6a737b"><i class="material-icons">get_app</i></a>'
            }else{
                download_btn = '';
            }

            if (news_id == url_id) {
                news_events.push(`
                                <div class="col-md-5" style=" padding: 0px 0px;">
                                    <img class="news-img" src="` + image + `" >
                                    </div>
                                    <div class="col-md-7" style="padding: 0px 0px">

                                    <!-- news title -->
                                    <h5 style="">` + title + ` </h5>

                                    <div class="col-md-12 mt-2" style="">

                                        <!-- news body -->
                                        <p class="pb-5">
                                            `+ description + `
                                        </p>
                                    </div>
                                    <div class="col-md-12 mt-3 mb-3 text-right" style="position: absolute; bottom: 0px; width: 100%; ">

                                        <button onclick="share(`+ news_id + `)" class="share btn btn-fab btn-round btn-sm sys-btn-raise" title="Copy this link" data-toggle="tooltip" data-placement="bottom" style="background: #00a78e">
                                            <i class="material-icons">share</i>
                                        </button>
                                        <button onclick="send_mail(`+ news_id + `)" class="btn btn-fab btn-round btn-rose btn-sm sys-btn-raise" title="Recieve as mail" data-toggle="tooltip" data-placement="bottom">
                                            <i class="material-icons">email</i>
                                        </button>
                                        ` + download_btn + `
                                    </div>
                                </div>
                                `);
            }
        });
    } else {
        news_events = [];
    }

    return news_events;
}

//queries all branches
function get_branches() {
    var response = connection.filter_data_form("branches");
    var branches_list = [];
    if (response.length > 0) {
        $.each(response, function (index, value) {
            var phone;
            if (value.phone) {
               phone = value.phone;
            }else{
                phone = "Not registered";
            }
             
            branches_list.push(`
                                <div class="col-lg-4">
                                    <div class="card card-contact card-raised pop-branch">
                                        <div class="card-header card-header-info text-center">
                                            <h4 class="card-title" style="font-family:'Samsung Sharp Sans Regular Regular' ">
                                            `+ value.name + `
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">

                                               <div class="col-lg-12 text-left">
                                                    <label class="col-lg-12" style="color: grey">
                                                        <div class="row">
                                                            <div class="col-sm-2" style="width:20%"><i class="icon-location4"></i></div>
                                                            <div class="col-sm-10" style="width:80%">`+ value.district + `, `+ value.street + `</div>
                                                        </div>
                                                    </label>
                                                    <label class="col-lg-12" style="color: grey">
                                                        <div class="row">
                                                            <div class="col-sm-2" style="width:20%"><i class="icon-phone"></i></div>
                                                            <div class="col-sm-10" style="width:80%">`+ phone + `</div>
                                                        </div>
                                                    </label>
                                                    <label class="col-lg-12"><a href="#" onclick="view_more('`+ value.id + `')" style="color:rgb(0, 151, 167) "><i class="icon-circle-right2"></i>&nbsp&nbsp&nbsp&nbsp View more</a></label>
                                               </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                `);
        });
    } else {
        branches_list = [];
    }
    return branches_list;
}


function get_photos() {
    var response = connection.filter_data_form("gallery");
    var photo_list = [];

    if (response.length > 0) {
        $.each(response, function (index, value) {
            var title = value['title'];
            var description = value['description'];
            var images = value['photo_list'];
            var image_list = [];
            $.each(images, function (index, value) {
                var image_raw = value['photo'];
                var image = image_raw;
                image_list.push(` <li class="col-xs-2 col-sm-2 col-md-2 img-mob" data-responsive="` + image + ` 800" data-src="` + image + `" data-sub-html="
                <h4>
                <!-- heading of the image -->
                `+ title + `
                </h4>
                <p>
                    <!-- caption starts here... -->
                `+ description + `
                </p>"
                >
                    <a href="">
                        <img class="img-responsive b-r-6" src="`+ image + `" style="">
                    </a>
                </li>
            `);
            });

            if (image_list.length > 0) {
                photo_list.push(`
                <h4 class="title text-left" style="border-bottom: 1px solid rgba(16, 94, 58, 0.3); padding-bottom: 5px;font-family: times">
                    `+ title + `
                </h4>
                <!-- loop photos here of this title -->
                <div class="demo-gallery" >
                    <ul class="list-unstyled row mb-3 lightgallery " style="justify-content: center;">
                    `+
                    image_list.join('')
                    + `
                        </ul>
                </div>
                `);
            }
        });
    }
    return photo_list;
}
// queries testimonials
function get_testimonials() {
    var response = connection.filter_data_form("testmonslist");
    var testimonial_list = [];
    if (response.length > 0) {
        $.each(response, function (index, value) {
            var customer_description, customer_name, description, image_raw, images;
            customer_name = value['customer_name'];
            description = value['description'];
            customer_description = value['customer_description'];
            image_raw = value['images'];
            images = image_raw;

            if (description != '') {

                if (description == '') {
                    description = 'No short decription of the testimony..';
                }
                if (customer_description == '') {
                    customer_description = 'No qoute from the beneficiary...';
                }
                if (customer_name == '') {
                    customer_name = 'No name of the beneficiary..';
                }

                testimonial_list.push(`
                <div class="col-md-4">
                        <div class="card card-blog">
                            <div class="card-header card-header-image">
                                    <img class="img" src="`+ images + `">
                            </div>
                            <div class="card-body">

                                <p class="card-category text-black">
                                    `+ description + `
                                </p>

                                <div class="card-description">
                                    <div >
                                        <div style="font-style: italic; border-left: 1px solid orange; font-size: 12.5px; padding-left: 2px">
                                        <span style="font-size: 25px">"</span>

                                        `+ customer_description + `

                                        <span style="font-size: 25px">"</span>
                                        </div>
                                    <footer>
                                        <cite>
                                            `+ customer_name + `
                                        </cite>
                                    </footer>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
            }
        });
    } else {
        testimonial_list.push(`
        <div class="media-body text-center">
            <p class="text-warning">
                <span><i class="icon-warning "></i></span>&nbsp &nbsp Fail to load data...!
            </p>
        </div>
        `);
    }
    return testimonial_list;
}

//get videos from APIs
function get_videos() {
    var response, videoList = [], videoAds = [], video_url, video_title, video_ad, videoNonAds = [], video_channel, videoNonAdsLength;
    response = connection.filter_data_form("gallery");
    var limiter;
    if (response.length > 0) {
        $.each(response, function (index, value) {
            if (value['video']) {

                video_url = value['video'];
                video_title = value['title'];
                video_ad = value['ads'];
                video_channel = value['channel'];

                if (video_channel != '') {
                    $('.channel_sub').html(`<label style="color: rgba(60, 72, 88,1);font-size: 16px">Visit Our Official Youtube Channel
                            <a href="`+ video_channel + `" class="btn btn-danger btn-round sys-btn-raise btn-sm" ><i class="icon-youtube"></i>
                            &nbsp&nbsp Youtube
                            </a></label>`);
                } else {
                    $('.channel_sub').html('<span style="color:orange"><i class="icon-alert"></i>&nbsp&nbspChannel not Registed!</span>')
                }

                if (video_ad) {
                    videoAds.push({
                        title: video_title,
                        url: video_url
                    });
                    var arryLength = videoAds.length;
                    arryLength--;
                    $('.mob-no-disp').html(`<iframe src="` + videoAds[arryLength]['url'] + `?autoplay=1&loop=1&controls=0" style="height: 300px;box-shadow: -8px 10px 10px 0px rgba(0,0,0,.25), 2px 0px 10px 1px rgba(0,0,0,.2);">
                            </iframe>`);
                } else {

                    videoNonAds.push({
                        title: value['title'],
                        url: value['video']
                    });
                }
                console.log(value['video']);
                videoNonAdsLength = videoNonAds.length;
                limiter = videoNonAdsLength - 6;
                if (limiter < 0) {
                    limiter = 0;
                }
                console.log("paul:" + videoNonAdsLength);
                videoNonAdsLength = videoNonAdsLength - 1;

            }
        });
        for (videoNonAdsLength; videoNonAdsLength >= limiter; videoNonAdsLength--) {
            videoList.push(`
                <div class="col-md-6 mt-3 vid-div">
                    <div class="iframe-container b-r-6">
                        <iframe src="`+ videoNonAds[videoNonAdsLength].url + `" frameborder="0"  allow="encrypted-media" allowfullscreen></iframe>

                        <div class="vid-hover-div">
                        </div>

                        <!-- youtube url -->
                        <a href="`+ videoNonAds[videoNonAdsLength].url + `" class="btn btn-danger btn-round sys-btn-raise btn-sm btn-play" ><i class="icon-play4"></i>&nbsp &nbsp Play
                        </a>
                        <div>
                            <!--  youtube url -->
                            <a href="">
                                <label class="text-info">
                                `+ videoNonAds[videoNonAdsLength].title + `
                                </label>
                            </a>
                        </div>
                    </div>
                </div>
            `);
        }
        if (videoList.length > 0) {
            $('.video_disp_container').html(videoList);
        } else {
            $('.video_disp_container').html(`

            <div class="danger-alert-vid">
            <!-- place here NIC Youtube channel URL -->
               <a href="`+ video_channel + `" class="text-danger" title="NIC Youtube Channel">No New Videos!, Visit our official Youtube channel.</a>
           </div>
            `);
        }
    }
}


//get products from APIs
function get_life_products() {

    //product_type = 1, means life product

    var response = [], productContainerList = [], productList = [], product_image,
    product_link, product_description, product_has_child,
    product_title, childList = [], product_child_title,
    product_child_image, product_child_description,
    product_child_link, product_id, product_type, productsSideBar= [];

    response = connection.filter_data_form("products");

    if (response.length > 0) {
        $.each(response, function (index, value) {
            product_type    = value['product_type'];
            product_title   = value['product_title'];
            product_id      = value['product_id'];
            product_image   = value['product_image'];
            product_link    = value['product_link'];
            product_description = value['product_description'];
            childList       = value['child_list'];
            product_has_child   = value['product_has_child'];
            // product_child_title = value['product_child_title'];
            // product_child_image = value['product_child_image'];
            // product_child_link  = value['product_child_link '];
            // product_child_description   = value['product_child_description'];

            if (product_type==1 && product_title!='') {
                product_image==null ?(
                    product_image = '../../assets/img/kit/products/'+defaultImage+''
                        ) : (
                            product_image = product_image
                )
                    //loop prouct names sidebar
                    productList.push({
                        "title":product_title,
                        "id":product_id,
                        'image':product_image,
                        'url':product_link,
                        'description':product_description,
                        'childArry':childList,
                        'has_child':product_has_child

                    });


            }
        });
        $.each(productList, function (index, value){
            if (index==0) {
                productsSideBar.push(`
                <li class="nav-item">
                            <a class="nav-link active" href="#tab`+index+`" data-toggle="tab">`+value.title+`</a>
                </li>
                `);

                if (value.has_child==true ) {

                    let childLooper =  [];
                    $.each(value.childArry, function(index,value){
                        let image = value.product_child_image;
                        image==null ? (
                            image = '../../assets/img/kit/products/'+defaultImage+''
                        ):(
                            image = image
                        );
                        childLooper.push(`
                        <div class="col-md-6">
                        <div class="card card-blog">
                            <div class="card-header card-header-image">
                                <a>
                                    <img src="`+image+`" alt="">
                                </a>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title">
                                    `+value.product_child_title+`
                                </h6>
                                <p class="">
                                `+value.product_child_description+`
                                </p>
                            </div>
                        </div>
                    </div>
                        `);
                    });

                    productContainerList.push(`
                    <div class="tab-pane" id="tab`+index+`">
                        <div class="sys-color-text" style="margin-bottom: 5px">
                            <i class=" icon-pencil-ruler" style="font-size: 30px;"></i>
                            <h4 class="info-title" style="display: inline-table;">`+value.title+` &nbsp&nbsp&nbsp `+product_btn(value.url)+`</h4>
                            <div class="row">
                                `+
                                 childLooper.join('')
                                +`
                            </div>
                        </div>

                        <h5 class="info-title">For more info Call (Free): 080 011 0041</h5>

                    </div>
                    `);


                }else{
                    productContainerList.push(`
                    <div class="tab-pane active" id="tab`+index+`">

                        <div class="col-md-12">
                            <div class=" card-blog">
                            <div class="row ">
                                <div class="card-header col-md-4" style="position: relative;padding: 0;z-index: 1;margin-left: 15px;margin-right: 15px;margin-top: -30px;border-radius: 6px;box-shadow: none;background: none;border-bottom:none;">
                                    <a>
                                        <img src="`+value.image+`" alt="" style="width: 100%;border-radius: 6px;pointer-events: none;box-shadow: 0 5px 25px -8px rgba(0, 0, 0, .54), 0 8px 20px -5px rgba(0, 0, 0, .2)">
                                    </a>
                                </div>
                                <div class="card-body col-md-7">
                                    <h5 class="card-title">
                                        `+value.title+`
                                        &nbsp&nbsp&nbsp `+product_btn(value.url)+`
                                    </h5>
                                    <p class="">
                                        `+value.description+`
                                    </p>
                                    <h5 class="info-title">
                                        For more info Call (Free): 080 011 0041
                                    </h5>
                                    &nbsp&nbsp&nbsp `+product_btn(value.url)+`
                                </div>
                            </div>
                            </div>
                        </div>

                    </div>
                    `)
                }//end inner IF of the index==0
             } else {

                productsSideBar.push(`
                <li class="nav-item">
                            <a class="nav-link" href="#tab`+index+`" data-toggle="tab">`+value.title+`</a>
                </li>
                `);

                if (value.has_child==true) {

                    let childLooper =  [];
                    $.each(value.childArry, function(index,value){

                    let image = value.product_child_image;
                    image==null ? (
                        image = '../../assets/img/kit/products/'+defaultImage+''
                    ):(
                        image = image
                    );
                        childLooper.push(`
                        <div class="col-md-6">
                        <div class="card card-blog">
                            <div class="card-header card-header-image">
                                <a>
                                    <img src="`+image+`" alt="">
                                </a>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title">
                                    `+value.product_child_title+`
                                </h6>
                                <p class="">
                                `+value.product_child_description+`
                                </p>
                            </div>
                        </div>
                    </div>
                        `);
                    });

                    productContainerList.push(`
                    <div class="tab-pane" id="tab`+index+`">
                        <div class="sys-color-text" style="margin-bottom: 5px">
                            <i class=" icon-pencil-ruler" style="font-size: 30px;"></i>
                            <h4 class="info-title" style="display: inline-table;">`+value.title+` &nbsp&nbsp&nbsp `+product_btn(value.product_child_link)+`</h4>
                            <div class="row">
                                `+
                                 childLooper.join('')
                                +`
                            </div>
                        </div>

                        <h5 class="info-title">For more info Call (Free): 080 011 0041</h5>

                    </div>
                    `);


                }else{
                    productContainerList.push(`
                    <div class="tab-pane" id="tab`+index+`">

                    <div class="col-md-12">
                        <div class=" card-blog">
                          <div class="row ">
                            <div class="card-header col-md-4" style="position: relative;padding: 0;z-index: 1;margin-left: 15px;margin-right: 15px;margin-top: -30px;border-radius: 6px;box-shadow: none;background: none;border-bottom:none;">
                                <a>
                                    <img src="`+value.image+`" alt="" style="width: 100%;border-radius: 6px;pointer-events: none;box-shadow: 0 5px 25px -8px rgba(0, 0, 0, .54), 0 8px 20px -5px rgba(0, 0, 0, .2)">
                                </a>
                            </div>
                            <div class="card-body col-md-7">
                                <h5 class="card-title">
                                    `+value.title+`
                                    &nbsp&nbsp&nbsp `+product_btn(value.url)+`
                                </h5>
                                <p class="">
                                    `+value.description+`
                                </p>
                                <h5 class="info-title">
                                    For more info Call (Free): 080 011 0041
                                </h5>
                                &nbsp&nbsp&nbsp `+product_btn(value.url)+`
                            </div>
                          </div>
                        </div>
                    </div>

                </div>
                    `)
                }
                }// end main if
        });
        $('.product_names_loop').html(productsSideBar);
        $('.tab-div').html(productContainerList);

    }

}

//get non life products
function get_non_life_products() {

     //product_type = 2, means non life product

    var response, product_link, product_description, product_image, product_title
    ,childList = [],product_id, product_type, productNameList = [], productList = [], productContainerList = [];
    response = connection.filter_data_form("products");
    if (response.length > 0) {
        $.each(response, function (index, value) {
            product_id = value['product_id'];
            product_link = value['product_link'];
            product_title = value['product_title'];
            product_description = value['product_description'];
            product_title = value['product_title'];
            product_title = value['product_title'];
            product_image = value['product_image'];
            product_has_child = value['product_has_child']
            product_type = value['product_type'];
            childList = value['child_list'];

            product_image==null ? (product_image = '../../assets/img/kit/products/'+defaultImage+'') : (product_image = product_image)

            if (product_type == 2 && product_title != '') {
                productList.push({
                    'product_id':product_id,
                    'product_title': product_title,
                    'image':product_image,
                    'product_has_child': product_has_child,
                    'product_description':product_description,
                    'url':product_link,
                    'childArry':childList,
                });
            }

        });

        $.each(productList, function(index, value){
            if(index==0){
                productNameList.push(` <li class="nav-item">
                <a class="nav-link active" href="#tab`+value['product_id']+`" data-toggle="tab">`+value['product_title']+`</a>
            </li>`);

            if (value.product_has_child == true) {
                let childLooper =  [];
                $.each(value.childArry, function(index,value){
                    let image = value.product_child_image;
                    image==null ? (
                        image = '../../assets/img/kit/products/'+defaultImage+''
                    ):(
                        image = image
                    );
                    childLooper.push(`
                    <div class="col-md-6">
                    <div class="card card-blog">
                        <div class="card-header card-header-image">
                            <a>
                                <img src="`+image+`" alt="">
                            </a>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">
                                `+value.product_child_title+`
                            </h6>
                            <p class="">
                            `+value.product_child_description+`
                            </p>
                        </div>
                    </div>
                </div>
                    `);
                });

                productContainerList.push(`
                <div class="tab-pane" id="tab`+value.product_id+`">
                    <div class="sys-color-text" style="margin-bottom: 5px">
                        <i class=" icon-pencil-ruler" style="font-size: 30px;"></i>
                        <h4 class="info-title" style="display: inline-table;">`+value.product_title+` &nbsp&nbsp&nbsp `+product_btn(value.url)+`</h4>
                        <div class="row">
                            `+
                             childLooper.join('')
                            +`
                        </div>
                    </div>

                    <h5 class="info-title">For more info Call (Free): 080 011 0041</h5>

                </div>
                `);

            } else {
                productContainerList.push(` <div class="tab-pane active" id="tab`+value.product_id+`">
                <div class="col-md-12">
                    <div class=" card-blog">
                      <div class="row ">
                        <div class="card-header col-md-4" style="position: relative;padding: 0;z-index: 1;margin-left: 15px;margin-right: 15px;margin-top: -30px;border-radius: 6px;box-shadow: none;background: none;border-bottom:none;">
                            <a>
                            <img src="`+value.image+`" alt="" style="width: 100%;border-radius: 6px;pointer-events: none;box-shadow: 0 5px 25px -8px rgba(0, 0, 0, .54), 0 8px 20px -5px rgba(0, 0, 0, .2)">
                            </a>
                        </div>
                        <div class="card-body col-md-7">
                            <h5 class="card-title">
                               `+value.product_title+`
                                &nbsp&nbsp `+product_btn(value.url)+`
                            </h5>
                            <p class="">
                            `+value.product_description+`
                            </p>
                            <h5 class="info-title">
                                For more info Call (Free): 080 011 0041
                            </h5>
                            &nbsp&nbsp `+product_btn(value.url)+`
                        </div>
                      </div>
                    </div>
                </div>

            </div>`);

            }

            } else {
                productNameList.push(`<li class="nav-item">
                <a class="nav-link" href="#tab`+value['product_id']+`" data-toggle="tab">`+value['product_title']+`</a>
            </li>`);

            if (value.product_has_child == true) {


                let childLooper =  [];
                $.each(value.childArry, function(index,value){

                let image = value.product_child_image;
                image==null ? (
                    image = '../../assets/img/kit/products/'+defaultImage+''
                ):(
                    image = image
                );
                    childLooper.push(`
                    <div class="col-md-6">
                    <div class="card card-blog">
                        <div class="card-header card-header-image">
                            <a>
                                <img src="`+image+`" alt="">
                            </a>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">
                                `+value.product_child_title+`
                            </h6>
                            <p class="">
                            `+value.product_child_description+`
                            </p>
                        </div>
                    </div>
                </div>
                    `);
                });

                productContainerList.push(`
                <div class="tab-pane" id="tab`+value.product_id+`">
                    <div class="sys-color-text" style="margin-bottom: 5px">
                        <i class=" icon-pencil-ruler" style="font-size: 30px;"></i>
                        <h4 class="info-title" style="display: inline-table;">`+value.product_title+` &nbsp&nbsp&nbsp `+product_btn(value.product_child_link)+`</h4>
                        <div class="row">
                            `+
                             childLooper.join('')
                            +`
                        </div>
                    </div>

                    <h5 class="info-title">For more info Call (Free): 080 011 0041</h5>

                </div>
                `);


            } else {
                productContainerList.push(` <div class="tab-pane" id="tab`+value.product_id+`">
                <div class="col-md-12">
                    <div class=" card-blog">
                      <div class="row ">
                        <div class="card-header col-md-4" style="position: relative;padding: 0;z-index: 1;margin-left: 15px;margin-right: 15px;margin-top: -30px;border-radius: 6px;box-shadow: none;background: none;border-bottom:none;">
                            <a>
                                <img src="`+value.image+`" alt="" style="width: 100%;border-radius: 6px;pointer-events: none;box-shadow: 0 5px 25px -8px rgba(0, 0, 0, .54), 0 8px 20px -5px rgba(0, 0, 0, .2)">
                            </a>
                        </div>
                        <div class="card-body col-md-7">
                            <h5 class="card-title">
                               `+value.product_title+`
                                &nbsp&nbsp `+product_btn(value.url)+`
                            </h5>
                            <p class="">
                            `+value.product_description+`
                            </p>
                            <h5 class="info-title">
                                For more info Call (Free): 080 011 0041
                            </h5>
                            &nbsp&nbsp `+product_btn(value.url)+`
                        </div>
                      </div>
                    </div>
                </div>

            </div>`);
          
            }
            }


        });

        $('.tab-list').html(productNameList);
        $('.tab-div').html(productContainerList);

    }


}

function product_btn(url){
    let btn;
    url != null ? (
     btn = `<a href="`+url+`" class="btn btn-sys-color btn-sm btn-round sys-btn-raise pull-right-1" style="text-transform: none;">
                    <i class="icon-cart4"></i>&nbsp&nbsp Purchase Bima
                </a>`
    ):(
        btn = ''
    )
        return btn;
}
