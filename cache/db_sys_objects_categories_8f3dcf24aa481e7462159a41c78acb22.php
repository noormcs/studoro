<?php $mixedData=array (
  'bx_articles' => 
  array (
    'ID' => '1',
    'ObjectName' => 'bx_articles',
    'Query' => 'SELECT `categories` FROM `bx_arl_entries` WHERE `id`=\'{iID}\' AND `status`=\'0\'',
    'PermalinkParam' => 'permalinks_module_articles',
    'EnabledPermalink' => 'm/articles/category/{tag}',
    'DisabledPermalink' => 'modules/?r=articles/category/{tag}',
    'LangKey' => '_articles_lcaption_categories',
  ),
  'bx_blogs' => 
  array (
    'ID' => '2',
    'ObjectName' => 'bx_blogs',
    'Query' => 'SELECT `Categories` FROM `bx_blogs_posts` WHERE `PostID` = {iID} AND `PostStatus` = \'approval\'',
    'PermalinkParam' => 'permalinks_blogs',
    'EnabledPermalink' => 'blogs/category/{tag}',
    'DisabledPermalink' => 'modules/boonex/blogs/blogs.php?action=category&uri={tag}',
    'LangKey' => '_bx_blog_Blogs',
  ),
  'bx_events' => 
  array (
    'ID' => '3',
    'ObjectName' => 'bx_events',
    'Query' => 'SELECT `Categories` FROM `bx_events_main` WHERE `ID` = {iID} AND `Status` = \'approved\'',
    'PermalinkParam' => 'bx_events_permalinks',
    'EnabledPermalink' => 'm/events/browse/category/{tag}',
    'DisabledPermalink' => 'modules/?r=events/browse/category/{tag}',
    'LangKey' => '_bx_events',
  ),
  'bx_groups' => 
  array (
    'ID' => '4',
    'ObjectName' => 'bx_groups',
    'Query' => 'SELECT `Categories` FROM `bx_groups_main` WHERE `id` = {iID} AND `status` = \'approved\'',
    'PermalinkParam' => 'bx_groups_permalinks',
    'EnabledPermalink' => 'm/groups/browse/category/{tag}',
    'DisabledPermalink' => 'modules/?r=groups/browse/category/{tag}',
    'LangKey' => '_bx_groups',
  ),
  'bx_news' => 
  array (
    'ID' => '6',
    'ObjectName' => 'bx_news',
    'Query' => 'SELECT `categories` FROM `bx_news_entries` WHERE `id`=\'{iID}\' AND `status`=\'0\'',
    'PermalinkParam' => 'permalinks_module_news',
    'EnabledPermalink' => 'm/news/category/{tag}',
    'DisabledPermalink' => 'modules/?r=news/category/{tag}',
    'LangKey' => '_news_lcaption_categories',
  ),
  'bx_poll' => 
  array (
    'ID' => '7',
    'ObjectName' => 'bx_poll',
    'Query' => 'SELECT `poll_categories` FROM `bx_poll_data` WHERE `id_poll`  = {iID} AND `poll_approval` = 1 AND `poll_status` = \'active\'',
    'PermalinkParam' => 'bx_poll_permalinks',
    'EnabledPermalink' => 'm/poll/?action=category&category={tag}',
    'DisabledPermalink' => 'modules/?r=poll/&action=category&category={tag}',
    'LangKey' => '_bx_polls',
  ),
  'bx_sounds' => 
  array (
    'ID' => '8',
    'ObjectName' => 'bx_sounds',
    'Query' => 'SELECT `Categories` FROM `RayMp3Files` WHERE `ID`  = {iID} AND `Status` = \'approved\'',
    'PermalinkParam' => 'bx_sounds_permalinks',
    'EnabledPermalink' => 'm/sounds/browse/category/{tag}',
    'DisabledPermalink' => 'modules/?r=sounds/browse/category/{tag}',
    'LangKey' => '_bx_sounds',
  ),
  'bx_videos' => 
  array (
    'ID' => '9',
    'ObjectName' => 'bx_videos',
    'Query' => 'SELECT `Categories` FROM `RayVideoFiles` WHERE `ID`  = {iID} AND `Status` = \'approved\'',
    'PermalinkParam' => 'bx_videos_permalinks',
    'EnabledPermalink' => 'm/videos/browse/category/{tag}',
    'DisabledPermalink' => 'modules/?r=videos/browse/category/{tag}',
    'LangKey' => '_bx_videos',
  ),
  'bx_files' => 
  array (
    'ID' => '10',
    'ObjectName' => 'bx_files',
    'Query' => 'SELECT `Categories` FROM `bx_files_main` WHERE `ID`  = {iID} AND `Status` = \'approved\'',
    'PermalinkParam' => 'bx_files_permalinks',
    'EnabledPermalink' => 'm/files/browse/category/{tag}',
    'DisabledPermalink' => 'modules/?r=files/files/category/{tag}',
    'LangKey' => '_bx_files',
  ),
  'bx_store' => 
  array (
    'ID' => '11',
    'ObjectName' => 'bx_store',
    'Query' => 'SELECT `Categories` FROM `bx_store_products` WHERE `id` = {iID} AND `status` = \'approved\'',
    'PermalinkParam' => 'bx_store_permalinks',
    'EnabledPermalink' => 'm/store/browse/category/{tag}',
    'DisabledPermalink' => 'modules/?r=store/browse/category/{tag}',
    'LangKey' => '_bx_store',
  ),
  'bx_photos' => 
  array (
    'ID' => '12',
    'ObjectName' => 'bx_photos',
    'Query' => 'SELECT `Categories` FROM `bx_photos_main` WHERE `ID`  = {iID} AND `Status` = \'approved\'',
    'PermalinkParam' => 'bx_photos_permalinks',
    'EnabledPermalink' => 'm/photos/browse/category/{tag}',
    'DisabledPermalink' => 'modules/?r=photos/browse/category/{tag}',
    'LangKey' => '_bx_photos',
  ),
  'bx_sites' => 
  array (
    'ID' => '13',
    'ObjectName' => 'bx_sites',
    'Query' => 'SELECT `categories` FROM `bx_sites_main` WHERE `id` = {iID} AND `status` = \'approved\'',
    'PermalinkParam' => 'bx_sites_permalinks',
    'EnabledPermalink' => 'm/sites/browse/category/{tag}',
    'DisabledPermalink' => 'modules/?r=sites/browse/category/{tag}',
    'LangKey' => '_bx_sites',
  ),
); ?>