DELIMITER $$
--
-- Procedury
--
DROP PROCEDURE IF EXISTS `update_project_status`$$
CREATE PROCEDURE `update_project_status`(IN projectId INT UNSIGNED)
BEGIN
    DECLARE viewCount INT;
    DECLARE acceptedViewCount INT;
    DECLARE rejectedViewCount INT;
    DECLARE acceptanceStatus TINYINT;

    SET @viewCount = (SELECT count(*) FROM `views` WHERE `project_id` = projectId);
    SET @acceptedViewCount = (SELECT count(*) FROM `views` WHERE `project_id` = projectId AND `acceptance_status`=1);
    SET @rejectedViewCount = (SELECT count(*) FROM `views` WHERE `project_id` = projectId AND `acceptance_status`=2);
    SET @acceptanceStatus = 0;
    IF @acceptedViewCount >= @viewCount THEN
        SET @acceptanceStatus = 1;
    END IF;
    UPDATE `projects` SET `view_count`=@viewCount, `accepted_view_count`=@acceptedViewCount, `acceptance_status`=@acceptanceStatus WHERE `id`=projectId;
END$$

DROP PROCEDURE IF EXISTS `update_version_status`$$
CREATE PROCEDURE `update_version_status`(IN versionId INT UNSIGNED)
BEGIN
    DECLARE commentCount INT;
    SET @commentCount = (SELECT count(*) FROM `comments` WHERE `version_id` = versionId);
    UPDATE `versions` SET `comment_count`=@commentCount WHERE `id`=versionId;
END$$

DROP PROCEDURE IF EXISTS `update_view_status`$$
CREATE PROCEDURE `update_view_status`(IN viewId INT UNSIGNED)
BEGIN
    DECLARE acceptedVersionCount INT;
    DECLARE rejectedVersionCount INT;
    DECLARE versionCount INT;
    DECLARE acceptanceStatus TINYINT;
    DECLARE commentCount INT;

    SET @versionCount = (SELECT count(*) FROM `versions` WHERE `view_id` = viewId AND `visible`=1);
    SET @commentCount = (SELECT sum(comment_count) FROM `versions` WHERE `view_id`=viewId AND `visible`=1);
    SET @acceptedVersionCount = (SELECT count(*) FROM `versions` WHERE `view_id`=viewId AND `acceptance_status`=1 AND `visible`=1);
    SET @rejectedVersionCount = (SELECT count(*) FROM `versions` WHERE `view_id`=viewId AND `acceptance_status`=2 AND `visible`=1);
    SET @acceptanceStatus = 0;
    IF @rejectedVersionCount = @versionCount THEN
        SET @acceptanceStatus = 2;
    END IF;
    IF @acceptedVersionCount > 0 THEN
        SET @acceptanceStatus = 1;
    END IF;
    # - wybór miniaturki
    SET @thumbPath = (SELECT thumb_path FROM `versions` WHERE `view_id`=viewId ORDER BY `number` DESC LIMIT 1);
    SET @thumbPathClient = (SELECT thumb_path FROM `versions` WHERE `view_id`=viewId AND `visible` = 1 ORDER BY `number` DESC LIMIT 1);

    UPDATE `views` SET
        `version_count`=@versionCount, `accepted_version_count`=@acceptedVersionCount, `acceptance_status`=@acceptanceStatus,
        `thumb_path`=@thumbPath, `thumb_path_client`=@thumbPathClient, `comment_count`=@commentCount
        WHERE `id`=viewId;
END$$

DELIMITER ;
