<?php $mixedData=array (
  'profile' => 
  array (
    'ID' => '1',
    'ObjectName' => 'profile',
    'Query' => 'SELECT `Tags` FROM `Profiles` WHERE `ID` = {iID} AND `Status` = \'Active\'',
    'PermalinkParam' => 'enable_modrewrite',
    'EnabledPermalink' => 'search/tag/{tag}',
    'DisabledPermalink' => 'search.php?Tags={tag}',
    'LangKey' => '_Profiles',
  ),
  'ad' => 
  array (
    'ID' => '2',
    'ObjectName' => 'ad',
    'Query' => 'SELECT `Tags` FROM `bx_ads_main` WHERE `ID` = {iID} AND `status` = \'active\'',
    'PermalinkParam' => 'permalinks_module_ads',
    'EnabledPermalink' => 'ads/tag/{tag}',
    'DisabledPermalink' => 'modules/boonex/ads/classifieds_tags.php?tag={tag}',
    'LangKey' => '_bx_ads_Ads',
  ),
  'bx_articles' => 
  array (
    'ID' => '3',
    'ObjectName' => 'bx_articles',
    'Query' => 'SELECT `tags` FROM `bx_arl_entries` WHERE `id`={iID} AND `status`=0',
    'PermalinkParam' => 'permalinks_module_articles',
    'EnabledPermalink' => 'm/articles/tag/{tag}',
    'DisabledPermalink' => 'modules/?r=articles/tag/{tag}',
    'LangKey' => '_articles_lcaption_tags',
  ),
  'blog' => 
  array (
    'ID' => '4',
    'ObjectName' => 'blog',
    'Query' => 'SELECT `Tags` FROM `bx_blogs_posts` WHERE `PostID` = {iID} AND `PostStatus` = \'approval\'',
    'PermalinkParam' => 'permalinks_blogs',
    'EnabledPermalink' => 'blogs/tag/{tag}',
    'DisabledPermalink' => 'modules/boonex/blogs/blogs.php?action=search_by_tag&tagKey={tag}',
    'LangKey' => '_bx_blog_Blogs',
  ),
  'bx_events' => 
  array (
    'ID' => '5',
    'ObjectName' => 'bx_events',
    'Query' => 'SELECT `Tags` FROM `bx_events_main` WHERE `ID` = {iID} AND `Status` = \'approved\'',
    'PermalinkParam' => 'bx_events_permalinks',
    'EnabledPermalink' => 'm/events/browse/tag/{tag}',
    'DisabledPermalink' => 'modules/?r=events/browse/tag/{tag}',
    'LangKey' => '_bx_events',
  ),
  'bx_feedback' => 
  array (
    'ID' => '6',
    'ObjectName' => 'bx_feedback',
    'Query' => 'SELECT `tags` FROM `bx_fdb_entries` WHERE `id`={iID} AND `status`=0',
    'PermalinkParam' => 'permalinks_module_feedback',
    'EnabledPermalink' => 'm/feedback/tags/{tag}',
    'DisabledPermalink' => 'modules/?r=feedback/tags/{tag}',
    'LangKey' => '_feedback_lcaption_tags_object',
  ),
  'bx_groups' => 
  array (
    'ID' => '7',
    'ObjectName' => 'bx_groups',
    'Query' => 'SELECT `Tags` FROM `bx_groups_main` WHERE `id` = {iID} AND `status` = \'approved\'',
    'PermalinkParam' => 'bx_groups_permalinks',
    'EnabledPermalink' => 'm/groups/browse/tag/{tag}',
    'DisabledPermalink' => 'modules/?r=groups/browse/tag/{tag}',
    'LangKey' => '_bx_groups',
  ),
  'bx_news' => 
  array (
    'ID' => '9',
    'ObjectName' => 'bx_news',
    'Query' => 'SELECT `tags` FROM `bx_news_entries` WHERE `id`={iID} AND `status`=0',
    'PermalinkParam' => 'permalinks_module_news',
    'EnabledPermalink' => 'm/news/tag/{tag}',
    'DisabledPermalink' => 'modules/?r=news/tag/{tag}',
    'LangKey' => '_news_lcaption_tags',
  ),
  'bx_poll' => 
  array (
    'ID' => '10',
    'ObjectName' => 'bx_poll',
    'Query' => 'SELECT `poll_tags` FROM `bx_poll_data` WHERE `id_poll` = {iID} AND `poll_approval` = 1 AND `poll_status` = \'active\' ',
    'PermalinkParam' => 'bx_poll_permalinks',
    'EnabledPermalink' => 'm/poll/tag/{tag}',
    'DisabledPermalink' => 'modules/?r=poll/tag/{tag}',
    'LangKey' => '_bx_polls',
  ),
  'bx_sounds' => 
  array (
    'ID' => '11',
    'ObjectName' => 'bx_sounds',
    'Query' => 'SELECT `Tags` FROM `RayMp3Files` WHERE `ID` = {iID} AND `Status` = \'approved\'',
    'PermalinkParam' => 'bx_sounds_permalinks',
    'EnabledPermalink' => 'm/sounds/browse/tag/{tag}',
    'DisabledPermalink' => 'modules/?r=sounds/browse/tag/{tag}',
    'LangKey' => '_bx_sounds',
  ),
  'bx_videos' => 
  array (
    'ID' => '12',
    'ObjectName' => 'bx_videos',
    'Query' => 'SELECT `Tags` FROM `RayVideoFiles` WHERE `ID` = {iID} AND `Status` = \'approved\'',
    'PermalinkParam' => 'bx_videos_permalinks',
    'EnabledPermalink' => 'm/videos/browse/tag/{tag}',
    'DisabledPermalink' => 'modules/?r=videos/browse/tag/{tag}',
    'LangKey' => '_bx_videos',
  ),
  'bx_files' => 
  array (
    'ID' => '13',
    'ObjectName' => 'bx_files',
    'Query' => 'SELECT `Tags` FROM `bx_files_main` WHERE `ID` = {iID} AND `Status` = \'approved\'',
    'PermalinkParam' => 'bx_files_permalinks',
    'EnabledPermalink' => 'm/files/browse/tag/{tag}',
    'DisabledPermalink' => 'modules/?r=files/browse/tag/{tag}',
    'LangKey' => '_bx_files',
  ),
  'bx_store' => 
  array (
    'ID' => '14',
    'ObjectName' => 'bx_store',
    'Query' => 'SELECT `Tags` FROM `bx_store_products` WHERE `id` = {iID} AND `status` = \'approved\'',
    'PermalinkParam' => 'bx_store_permalinks',
    'EnabledPermalink' => 'm/store/browse/tag/{tag}',
    'DisabledPermalink' => 'modules/?r=store/browse/tag/{tag}',
    'LangKey' => '_bx_store',
  ),
  'bx_photos' => 
  array (
    'ID' => '15',
    'ObjectName' => 'bx_photos',
    'Query' => 'SELECT `Tags` FROM `bx_photos_main` WHERE `ID` = {iID} AND `Status` = \'approved\'',
    'PermalinkParam' => 'bx_photos_permalinks',
    'EnabledPermalink' => 'm/photos/browse/tag/{tag}',
    'DisabledPermalink' => 'modules/?r=photos/browse/tag/{tag}',
    'LangKey' => '_bx_photos',
  ),
  'bx_sites' => 
  array (
    'ID' => '16',
    'ObjectName' => 'bx_sites',
    'Query' => 'SELECT `tags` FROM `bx_sites_main` WHERE `id` = {iID} AND `status` = \'approved\'',
    'PermalinkParam' => 'bx_sites_permalinks',
    'EnabledPermalink' => 'm/sites/browse/tag/{tag}',
    'DisabledPermalink' => 'modules/?r=sites/browse/tag/{tag}',
    'LangKey' => '_bx_sites',
  ),
); ?>