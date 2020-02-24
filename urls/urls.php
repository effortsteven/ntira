<?php

use Config\Route;
use Symfony\Component\Debug\Debug;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\DebugClassLoader;
Debug::enable();
ErrorHandler::register();
DebugClassLoader::enable();

// url /
Route::path("/", new \System\views\HomeView());

Route::path("/about/", new \System\views\AboutView());

Route::path("/testimon/", new \System\views\TestimonView());

Route::path("/tenders_careers/",new \System\views\TenderView());

Route::path("/life_products/",new \System\views\LifeProductView());

Route::path("/non_life_products/",new \System\views\NonLifeProductView());

Route::path("/photos/",new \System\views\PhotoView());

Route::path("/videos/",new \System\views\VideoView());

Route::path("/news_and_events/",new \System\views\NewsAndEventsView());

Route::path("/contact/",new \System\views\ContactView());

Route::path("/readmore/[:id]/",new \System\views\ReadMoreView());

Route::path("/branch/[:id]/",new \System\views\BranchView());

// url /news_feed_api/
Route::path("/news_feed_api/",new \System\views\NewsFeedView());

Route::path("/edit_news_feeds/[:id]/", new \System\views\EditNewsFeedView());

Route::path("/delete_news_feeds/[:id]/", new \System\views\DeleteNewsFeed());


Route::path("/web_product_list/",new \System\views\WebProductList());

Route::path("/new_web_product_form_api/",new \System\views\NewWebProductFormApiView());

Route::path("/edit_web_products/", new \System\views\EditWebProductView());

Route::path("/delete_web_product/[:id]/", new \System\views\DeleteWebProduct());


Route::path("/inner_web_product_list/[:id]/",new \System\views\InnerWebProductListView());

Route::path("/inner_web_product/[:id]/",new \System\views\InnerWebProductById());

Route::path("/edit_inner_web_products/[:id]/",new \System\views\EditInnerWebProductView());

Route::path("/delete_inner_web_product/[:id]/",new \System\views\DeleteInnerWebProductView());


Route::path("/testmons_list/",new \System\views\TestimonListView());

Route::path("/new_testmon/",new \System\views\NewTestimonApi());

Route::path("/testmon_by_id/[:id]/",new \System\views\TestimonByIdView());

Route::path("/edit_testmon/[:id]/",new \System\views\EditTestimonView());

Route::path("/delete_testmon/[:id]/",new \System\views\DeleteTestimonView());



Route::path("/tender_list/",new \System\views\TenderListView());

Route::path("/new_tender/",new \System\views\NewTenderView());

Route::path("/edit_tender/[:id]/",new \System\views\EditTenderView());

Route::path("/tender_by_id/[:id]/",new \System\views\TenderByIdView());

Route::path("/delete_tender/[:id]/",new \System\views\DeleteTenderView());



Route::path("/career_list/",new \System\views\CareerListView());

Route::path("/new_career/",new \System\views\NewCareerView());

Route::path("/career_by_id/[:id]/",new \System\views\CareerByidView());

Route::path("/edit_career/[:id]/",new \System\views\EditCareerView());

Route::path("/delete_career/[:id]/",new \System\views\DeleteCareerView());


Route::path("/application_list/[:id]/",new \System\views\JobApplicationListView());

Route::path("/delete_application/[:id]/",new \System\views\DeleteJobapplication());

Route::path("/educationInfo/[:id]/",new \System\views\EducationInfoListView());



Route::path("/jobobjective_list/[:id]/",new \System\views\JobObjectiveListView());

Route::path("/jobobjective_by_id/[:id]/",new \System\views\JobObjectiveByIdView());

Route::path("/edit_jobobjective/[:id]/",new \System\views\EditJobObjectiveView());

Route::path("/delete_job_objective/[:id]/",new \System\views\DeleteJobObjectiveView());


Route::path("/qualification_and_experience_list/[:id]/",new \System\views\QualityAndExperienceListView());

Route::path("/qualification_and_experience_by_id/[:id]/",new \System\views\QualityAndExperienceByIdView());

Route::path("/edit_qualification_and_experience/[:id]/",new \System\views\EditQualityAndExperienceView());



Route::path("/gallery_list/",new \System\views\GalleryListView());

Route::path("/new_gallery/",new \System\views\NewGalleryView());

Route::path("/gallery_by_id/[:id]/",new \System\views\GalleryByIdView());

Route::path("/edit_gallery/[:id]/", new \System\views\EditGalleryView());

Route::path("/delete_gallery/[:id]/",new \System\views\DeleteGalleryView());

Route::path("/delete_gallery_photo/[:id]/",new \System\views\DeleteGalleryphotoView());


Route::path("/newChannel/",new \System\views\ChannelView());

Route::path("/delete_channel/[:id]/",new \System\views\DeleteChannelView());

