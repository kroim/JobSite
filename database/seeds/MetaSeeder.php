<?php

/**
 * Class SiteManagementSeeder.
 *
 * @category Worketic
 *
 * @package Worketic
 * @author  Amentotech <theamentotech@gmail.com>
 * @license http://www.amentotech.com Amentotech
 * @link    http://www.amentotech.com
 */
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helper;

/**
 * Class MetaSeeder
 */

class MetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('metas')->insert(
            [
                [
                    'meta_key' => 'content0',
                    'meta_value' => Helper::getAboutSeeder(),
                    'metable_type' => 'App\Page',
                    'metable_id' => 2,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'title',
                    'meta_value' => 1,
                    'metable_type' => 'App\Page',
                    'metable_id' => 2,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'cat1',
                    'meta_value' => Helper::getFirstHomeCat(),
                    'metable_type' => 'App\Page',
                    'metable_id' => 5,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'welcome_sections3',
                    'meta_value' => 'a:11:{s:18:"welcome_background";s:32:"1579153406-1557484284-banner.jpg";s:11:"first_title";s:16:"Start As Company";s:9:"first_url";s:1:"#";s:16:"first_url_button";s:8:"JOIN NOW";s:17:"first_description";s:172:"Consectetur adipisicing elit sed dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina ilukita ylokem lokateise ination voluptate velit esse cillum.";s:12:"second_title";s:19:"Start As Freelancer";s:10:"second_url";s:1:"#";s:17:"second_url_button";s:8:"JOIN NOW";s:18:"second_description";s:172:"Consectetur adipisicing elit sed dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina ilukita ylokem lokateise ination voluptate velit esse cillum.";s:2:"id";i:4;s:11:"parentIndex";i:3;}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 5,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'sliders0',
                    'meta_value' => 'a:17:{s:5:"style";s:6:"style1";s:12:"slider_image";a:1:{i:0;s:14:"banner-img.jpg";}s:18:"inner_banner_image";s:26:"1579153511-img-01inner.png";s:16:"floating_image01";s:21:"1579153511-img-02.png";s:16:"floating_image02";s:21:"1579153511-img-03.png";s:5:"title";s:23:"Hire expert freelancers";s:8:"subtitle";s:19:"for any job, Online";s:11:"description";s:108:"<p>Consectetur adipisicing elit sed dotem eiusmod tempor incuntes ut labore etdolore maigna aliqua enim.</p>";s:10:"video_link";s:43:"https://www.youtube.com/watch?v=J37W6DjqT3Q";s:11:"video_title";s:17:"See For Yourself!";s:17:"video_description";s:43:"How it works & experience the ultimate joy.";s:2:"id";i:1;s:11:"parentIndex";i:0;s:10:"titleColor";s:7:"#ffffff";s:13:"subtitleColor";s:7:"#ffffff";s:12:"taglineColor";s:7:"#ffffff";s:12:"sectionColor";s:7:"#d1d1d1";}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 5,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'app_section4',
                    'meta_value' => Helper::getFirstHomeAPP(),
                    'metable_type' => 'App\Page',
                    'metable_id' => 5,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'title',
                    'meta_value' => 0,
                    'metable_type' => 'App\Page',
                    'metable_id' => 5,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'freelancers3',
                    'meta_value' => Helper::getSecondHomeFreelancer(),
                    'metable_type' => 'App\Page',
                    'metable_id' => 6,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'services1',
                    'meta_value' => Helper::getSecondHomeService(),
                    'metable_type' => 'App\Page',
                    'metable_id' => 6,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'work_tabs2',
                    'meta_value' => Helper::getSecondHomeWorkTab(),
                    'metable_type' => 'App\Page',
                    'metable_id' => 6,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'sliders0',
                    'meta_value' => 'a:14:{s:5:"style";s:6:"style2";s:12:"slider_image";a:4:{i:0;s:21:"1579164321-img-01.jpg";i:1;s:21:"1579164321-img-02.jpg";i:2;s:21:"1579164321-img-03.jpg";i:3;s:21:"1579164321-img-04.jpg";}s:5:"title";s:23:"Hire expert freelancers";s:8:"subtitle";s:19:"for any job, Online";s:11:"description";s:160:"<p>Consectetur adipisicing elition sed dotem eiusmod tempor incuntes ut labore etdolore maigna aliqua enim adion minim veniam quistan neostrud exercitation.</p>";s:10:"video_link";s:28:"https://youtu.be/B-ph2g5o2K4";s:11:"video_title";s:17:"See For Yourself!";s:17:"video_description";s:43:"How it works & experience the ultimate joy.";s:2:"id";i:1;s:11:"parentIndex";i:0;s:10:"titleColor";s:7:"#ffffff";s:13:"subtitleColor";s:7:"#ffffff";s:12:"taglineColor";s:7:"#ffffff";s:12:"sectionColor";s:7:"#afafaf";}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 6,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'app_section4',
                    'meta_value' => Helper::getSecondHomeAPP(),
                    'metable_type' => 'App\Page',
                    'metable_id' => 6,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'articles5',
                    'meta_value' => Helper::getSecondHomeArticle(),
                    'metable_type' => 'App\Page',
                    'metable_id' => 6,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'title',
                    'meta_value' => 0,
                    'metable_type' => 'App\Page',
                    'metable_id' => 6,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'freelancers3',
                    'meta_value' => Helper::getThirdHomeFreelancer(),
                    'metable_type' => 'App\Page',
                    'metable_id' => 7,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'services1',
                    'meta_value' => Helper::getThirdHomeService(),
                    'metable_type' => 'App\Page',
                    'metable_id' => 7,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'work_videos2',
                    'meta_value' => Helper::getThirdHomeWorkVideo(),
                    'metable_type' => 'App\Page',
                    'metable_id' => 7,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'sliders0',
                    'meta_value' => 'a:16:{s:5:"style";s:6:"style3";s:12:"slider_image";a:2:{i:0;s:21:"1579166079-img-04.jpg";i:1;s:21:"1579166079-img-05.jpg";}s:5:"title";s:23:"Buy expert’s Services";s:8:"subtitle";s:19:"for any job, Online";s:11:"description";s:160:"<p>Consectetur adipisicing elition sed dotem eiusmod tempor incuntes ut labore etdolore maigna aliqua enim adion minim veniam quistan neostrud exercitation.</p>";s:10:"video_link";s:28:"https://youtu.be/B-ph2g5o2K4";s:11:"video_title";s:17:"See For Yourself!";s:17:"video_description";s:43:"How it works & experience the ultimate joy.";s:2:"id";i:1;s:11:"parentIndex";i:0;s:10:"titleColor";s:7:"#ff5851";s:13:"subtitleColor";s:7:"#323232";s:12:"taglineColor";s:7:"#000000";s:12:"sectionColor";s:7:"#ffffff";s:16:"floating_image01";s:32:"1590064417-1579166079-img-05.png";s:16:"floating_image02";s:21:"1590064417-img-06.png";}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 7,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'app_section4',
                    'meta_value' => Helper::getThirdHomeAPP(),
                    'metable_type' => 'App\Page',
                    'metable_id' => 7,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'articles5',
                    'meta_value' => Helper::getThirdHomeArticle(),
                    'metable_type' => 'App\Page',
                    'metable_id' => 7,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'title',
                    'meta_value' => 0,
                    'metable_type' => 'App\Page',
                    'metable_id' => 7,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                // HomePage V4
                [
                    'meta_key' => 'app_section3',
                    'meta_value' => 'a:21:{s:5:"title";s:8:"Download";s:8:"titleTwo";s:18:"Mobile Application";s:8:"subtitle";s:22:"Double Your Experience";s:11:"description";s:698:"<p>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore ete dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><ul class="wt-mobapp-listing"><li><span>Duis aute irure dolor in reprehenderit</span></li><li><span>Voluptate velit esse cillum dolore</span></li><li><span>Fugiat nulla pariatur. Excepteur sint occaecat</span></li><li><span>Cupidatat non proident sunt in culpa</span></li><li><span>Qui officia deserunt mollit anim</span></li></ul><div class="wt-description"><p>Laborum ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p></div>";s:11:"andriod_url";s:1:"#";s:7:"ios_url";s:1:"#";s:16:"background_image";s:21:"1588069315-img-05.png";s:9:"app_image";s:21:"1588069315-mobile.png";s:5:"style";s:6:"style3";s:12:"sectionColor";s:7:"#ffffff";s:10:"titleColor";s:7:"#3d4461";s:13:"titleTwoColor";s:7:"#f62b84";s:13:"subtitleColor";s:7:"#3d4461";s:7:"padding";a:5:{s:3:"top";s:2:"80";s:5:"right";i:0;s:6:"bottom";s:2:"80";s:4:"left";i:0;s:4:"unit";s:2:"px";}s:6:"margin";a:5:{s:3:"top";i:0;s:5:"right";i:0;s:6:"bottom";i:0;s:4:"left";i:0;s:4:"unit";s:2:"px";}s:9:"sectionId";N;s:12:"sectionClass";N;s:2:"id";i:4;s:11:"parentIndex";i:3;s:9:"ios_image";s:21:"1590763420-img-02.png";s:13:"android_image";s:21:"1590763420-img-01.png";}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'categoriesSecondVersion1',
                    'meta_value' => 'a:16:{s:5:"title";s:8:"Trending";s:8:"subtitle";s:14:"Top Categories";s:11:"description";s:75:"Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina";s:12:"sectionColor";s:7:"#ffffff";s:13:"backgroundImg";s:21:"1588069315-img-04.png";s:10:"titleColor";s:7:"#3d4461";s:13:"subtitleColor";s:7:"#f62b84";s:13:"showAllBtnUrl";s:1:"#";s:12:"lastTabTitle";s:18:"Explore Categories";s:11:"lastTabDesc";s:59:"Consectetur adipisicing elit deius temor incididunt utnenbo";s:7:"padding";a:5:{s:3:"top";s:2:"80";s:5:"right";i:0;s:6:"bottom";s:2:"80";s:4:"left";i:0;s:4:"unit";s:2:"px";}s:6:"margin";a:5:{s:3:"top";i:0;s:5:"right";i:0;s:6:"bottom";i:0;s:4:"left";i:0;s:4:"unit";s:2:"px";}s:9:"sectionId";N;s:12:"sectionClass";N;s:2:"id";i:2;s:11:"parentIndex";i:1;}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'freelancersSecondVersion4',
                    'meta_value' => 'a:13:{s:5:"title";s:3:"Top";s:8:"titleTwo";s:11:"Freelancers";s:11:"description";s:83:"Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina ilukita";s:13:"backgroundImg";s:21:"1588069315-img-03.png";s:12:"sectionColor";s:7:"#f5f7fa";s:10:"titleColor";s:7:"#3d4461";s:13:"titleTwoColor";s:7:"#f62b84";s:7:"padding";a:5:{s:3:"top";s:2:"80";s:5:"right";i:0;s:6:"bottom";s:2:"80";s:4:"left";i:0;s:4:"unit";s:2:"px";}s:6:"margin";a:5:{s:3:"top";s:3:"108";s:5:"right";i:0;s:6:"bottom";i:0;s:4:"left";i:0;s:4:"unit";s:2:"px";}s:9:"sectionId";N;s:12:"sectionClass";N;s:2:"id";i:5;s:11:"parentIndex";i:4;}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'jobs2',
                    'meta_value' => 'a:13:{s:5:"title";s:6:"Latest";s:8:"titleTwo";s:12:"Jobs Opening";s:11:"description";s:83:"Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina ilukita";s:13:"backgroundImg";s:21:"1588069316-img-02.png";s:12:"sectionColor";s:7:"#f5f7fa";s:10:"titleColor";s:7:"#3d4461";s:13:"titleTwoColor";s:7:"#f62b84";s:7:"padding";a:5:{s:3:"top";s:2:"80";s:5:"right";i:0;s:6:"bottom";s:2:"80";s:4:"left";i:0;s:4:"unit";s:2:"px";}s:6:"margin";a:5:{s:3:"top";s:3:"108";s:5:"right";i:0;s:6:"bottom";i:0;s:4:"left";i:0;s:4:"unit";s:2:"px";}s:9:"sectionId";N;s:12:"sectionClass";N;s:2:"id";i:3;s:11:"parentIndex";i:2;}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'packages5',
                    'meta_value' => 'a:13:{s:5:"title";s:3:"Top";s:8:"titleTwo";s:8:"Packages";s:11:"description";s:83:"Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina ilukita";s:12:"sectionColor";s:7:"#ffffff";s:13:"backgroundImg";s:21:"1588652284-img-04.png";s:10:"titleColor";s:7:"#3d4461";s:13:"titleTwoColor";s:7:"#f62b84";s:7:"padding";a:5:{s:3:"top";s:2:"80";s:5:"right";i:0;s:6:"bottom";s:3:"100";s:4:"left";i:0;s:4:"unit";s:2:"px";}s:6:"margin";a:5:{s:3:"top";i:0;s:5:"right";i:0;s:6:"bottom";s:1:"0";s:4:"left";i:0;s:4:"unit";s:2:"px";}s:9:"sectionId";N;s:12:"sectionClass";N;s:2:"id";i:6;s:11:"parentIndex";i:5;}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'bannerFirstVersion0',
                    'meta_value' => 'a:17:{s:5:"title";s:23:"Most Powerful Directory";s:8:"subtitle";s:31:"Available for Service Providers";s:10:"videoTitle";s:17:"See For Yourself!";s:9:"videoDesc";s:43:"How it works & experience the ultimate joy.";s:8:"videoUrl";s:1:"#";s:13:"backgroundImg";s:21:"1588069316-img-01.jpg";s:8:"frontImg";s:32:"1588069316-1587028317-img-01.png";s:14:"showSearchForm";b:1;s:12:"sectionColor";s:7:"#ffffff";s:10:"titleColor";s:7:"#ffffff";s:13:"subtitleColor";s:7:"#ffffff";s:7:"padding";a:5:{s:3:"top";s:2:"96";s:5:"right";i:0;s:6:"bottom";s:2:"96";s:4:"left";i:0;s:4:"unit";s:2:"px";}s:6:"margin";a:5:{s:3:"top";i:0;s:5:"right";i:0;s:6:"bottom";i:0;s:4:"left";i:0;s:4:"unit";s:2:"px";}s:9:"sectionId";N;s:12:"sectionClass";N;s:2:"id";i:1;s:11:"parentIndex";i:0;}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'header',
                    'meta_value' => 'style4',
                    'metable_type' => 'App\Page',
                    'metable_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'footer',
                    'meta_value' => 'style2',
                    'metable_type' => 'App\Page',
                    'metable_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'title',
                    'meta_value' => 0,
                    'metable_type' => 'App\Page',
                    'metable_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                // Home v5
                [
                    'meta_key' => 'app_section3',
                    'meta_value' => 'a:21:{s:5:"title";s:8:"Download";s:8:"titleTwo";s:18:"Mobile Application";s:8:"subtitle";s:22:"Double Your Experience";s:11:"description";s:664:"<p>Consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore ete dolore magna aliqua enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p><ul class="wt-mobapp-listing"><li><span>Duis aute irure dolor in reprehenderit</span></li><li><span>Voluptate velit esse cillum dolore</span></li><li><span>Fugiat nulla pariatur. Excepteur sint occaecat</span></li><li><span>Cupidatat non proident sunt in culpa</span></li><li><span>Qui officia deserunt mollit anim</span></li></ul><p>Laborum ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>";s:11:"andriod_url";s:1:"#";s:7:"ios_url";s:1:"#";s:16:"background_image";s:21:"1588246876-img-05.png";s:9:"app_image";s:21:"1588246876-mobile.png";s:5:"style";s:6:"style3";s:12:"sectionColor";s:7:"#ffffff";s:10:"titleColor";s:7:"#3d4461";s:13:"titleTwoColor";s:7:"#f62b84";s:13:"subtitleColor";s:7:"#3d4461";s:7:"padding";a:5:{s:3:"top";s:2:"80";s:5:"right";i:0;s:6:"bottom";s:2:"80";s:4:"left";i:0;s:4:"unit";s:2:"px";}s:6:"margin";a:5:{s:3:"top";i:0;s:5:"right";i:0;s:6:"bottom";i:0;s:4:"left";i:0;s:4:"unit";s:2:"px";}s:9:"sectionId";N;s:12:"sectionClass";N;s:2:"id";i:4;s:11:"parentIndex";i:3;s:9:"ios_image";s:21:"1590763876-img-02.png";s:13:"android_image";s:21:"1590763876-img-01.png";}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'freelancersSecondVersion4',
                    'meta_value' => 'a:13:{s:5:"title";s:3:"Top";s:8:"titleTwo";s:11:"Freelancers";s:11:"description";s:90:"<p>Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina ilukita</p>";s:13:"backgroundImg";s:21:"1588246876-img-03.png";s:12:"sectionColor";s:7:"#f5f7fa";s:10:"titleColor";s:7:"#3d4461";s:13:"titleTwoColor";s:7:"#9013fe";s:7:"padding";a:5:{s:3:"top";s:2:"80";s:5:"right";i:0;s:6:"bottom";s:2:"80";s:4:"left";i:0;s:4:"unit";s:2:"px";}s:6:"margin";a:5:{s:3:"top";s:3:"108";s:5:"right";i:0;s:6:"bottom";i:0;s:4:"left";i:0;s:4:"unit";s:2:"px";}s:9:"sectionId";N;s:12:"sectionClass";N;s:2:"id";i:5;s:11:"parentIndex";i:4;}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'jobs2',
                    'meta_value' => 'a:13:{s:5:"title";s:6:"Latest";s:8:"titleTwo";s:12:"Jobs Opening";s:11:"description";s:83:"Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina ilukita";s:13:"backgroundImg";s:21:"1588246877-img-02.png";s:12:"sectionColor";s:7:"#f5f7fa";s:10:"titleColor";s:7:"#3d4461";s:13:"titleTwoColor";s:7:"#9013f3";s:7:"padding";a:5:{s:3:"top";s:2:"80";s:5:"right";i:0;s:6:"bottom";s:2:"80";s:4:"left";i:0;s:4:"unit";s:2:"px";}s:6:"margin";a:5:{s:3:"top";s:3:"108";s:5:"right";i:0;s:6:"bottom";i:0;s:4:"left";i:0;s:4:"unit";s:2:"px";}s:9:"sectionId";N;s:12:"sectionClass";N;s:2:"id";i:3;s:11:"parentIndex";i:2;}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'packages5',
                    'meta_value' => 'a:13:{s:5:"title";s:3:"Top";s:8:"titleTwo";s:8:"Packages";s:11:"description";s:83:"Dotem eiusmod tempor incune utnaem labore etdolore maigna alie enim poskina ilukita";s:12:"sectionColor";s:7:"#ffffff";s:13:"backgroundImg";s:21:"1588246877-img-04.png";s:10:"titleColor";s:7:"#3d4461";s:13:"titleTwoColor";s:7:"#9013fe";s:7:"padding";a:5:{s:3:"top";s:2:"80";s:5:"right";i:0;s:6:"bottom";s:3:"100";s:4:"left";i:0;s:4:"unit";s:2:"px";}s:6:"margin";a:5:{s:3:"top";i:0;s:5:"right";i:0;s:6:"bottom";i:0;s:4:"left";i:0;s:4:"unit";s:2:"px";}s:9:"sectionId";N;s:12:"sectionClass";N;s:2:"id";i:6;s:11:"parentIndex";i:5;}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'sliders0',
                    'meta_value' => 'a:24:{s:5:"style";s:6:"style4";s:12:"slider_image";a:4:{i:0;s:21:"1588246877-img-01.jpg";i:1;s:21:"1588246878-img-02.jpg";i:2;s:21:"1588246878-img-03.jpg";i:3;s:21:"1588246878-img-04.jpg";}s:5:"title";s:15:"Title Your Need";s:8:"subtitle";s:16:"We Have Everyone";s:7:"tagline";s:25:"Looking For Professional?";s:11:"description";s:208:"<p>Consectetur adipisicing elition sedames dotem iusmod temporei incuntes utnalo labore etdolore maina aliqua enim adion minim veniam quis nsitrud exercitation ullamco laboris nisiutaliquip ex ea commodo.</p>";s:10:"video_link";N;s:11:"video_title";N;s:17:"video_description";s:0:"";s:12:"taglineColor";s:7:"#ffffff";s:10:"titleColor";s:7:"#ffffff";s:13:"subtitleColor";s:7:"#ffffff";s:12:"sectionColor";s:7:"#ffffff";s:7:"padding";a:5:{s:3:"top";i:0;s:5:"right";i:0;s:6:"bottom";i:0;s:4:"left";i:0;s:4:"unit";s:2:"px";}s:6:"margin";a:5:{s:3:"top";i:0;s:5:"right";i:0;s:6:"bottom";i:0;s:4:"left";i:0;s:4:"unit";s:2:"px";}s:9:"sectionId";N;s:12:"sectionClass";N;s:2:"id";i:1;s:11:"parentIndex";i:0;s:18:"enable_search_form";b:1;s:17:"search_form_title";s:25:"That Help You To Go Ahead";s:20:"search_form_subtitle";s:22:"Best Service Providers";s:17:"price_range_title";s:12:"Price Range:";s:15:"listing_tagline";s:33:"more than 2500 listings available";}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'categoriesThirdVersion1',
                    'meta_value' => 'a:16:{s:5:"title";s:9:"Versatile";s:8:"titleTwo";s:10:"Categories";s:8:"subtitle";s:16:"Explore with our";s:11:"description";s:200:"<p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina ilukita ylokem lokateise ination voluptate velit esse cillum dolore eunfugiat nulla pariatur lokaim urianewce sint.</p>";s:12:"sectionColor";s:7:"#ffffff";s:13:"backgroundImg";s:21:"1588246878-img-01.png";s:10:"titleColor";s:7:"#3d4461";s:13:"titleTwoColor";s:7:"#9013fe";s:13:"subtitleColor";s:7:"#3d4461";s:13:"showAllBtnUrl";s:1:"#";s:7:"padding";a:5:{s:3:"top";s:3:"160";s:5:"right";i:0;s:6:"bottom";s:3:"160";s:4:"left";i:0;s:4:"unit";s:2:"px";}s:6:"margin";a:5:{s:3:"top";i:0;s:5:"right";i:0;s:6:"bottom";i:0;s:4:"left";i:0;s:4:"unit";s:2:"px";}s:9:"sectionId";N;s:12:"sectionClass";N;s:2:"id";i:2;s:11:"parentIndex";i:1;}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'header',
                    'meta_value' => 'style5',
                    'metable_type' => 'App\Page',
                    'metable_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'footer',
                    'meta_value' => 'style3',
                    'metable_type' => 'App\Page',
                    'metable_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'title',
                    'meta_value' => 0,
                    'metable_type' => 'App\Page',
                    'metable_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                // header styling
                [
                    'meta_key' => 'header_styling',
                    'meta_value' => 'a:4:{s:4:"logo";N;s:9:"menuColor";s:7:"#ffffff";s:14:"menuHoverColor";s:7:"#fbde44";s:5:"color";s:7:"#ffffff";}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 9,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
                [
                    'meta_key' => 'header_styling',
                    'meta_value' => 'a:4:{s:4:"logo";N;s:9:"menuColor";s:7:"#ffffff";s:14:"menuHoverColor";s:7:"#fbde44";s:5:"color";s:7:"#ffffff";}',
                    'metable_type' => 'App\Page',
                    'metable_id' => 8,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                ],
            ]
        );
    }
}
