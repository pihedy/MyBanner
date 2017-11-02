<?php
// no direct access
defined( 'ABSPATH' ) or die;
?>
<div class="wrap">

    <h1>
        <?php echo $pluginData['Name'] ?>
    </h1>

    <form id="myBannerUpload" method="post">
        <table>
            <tr>
                <td>Kép</td>
                <td>Banner cím</td>
                <td>Oldal URL</td>
                <td>Mentés</td>
            </tr>
            <tr>
                <td id="myBannerImage">
                    <input id="upload-button" type="button" class="button" value="Upload Image" />
                    <input type="hidden" name="bannerUrl" id="image-url" />
                </td>
                <td>
                    <input type="text" name="bannerTitle" />
                </td>
                <td>
                    <input type="text" name="pageLink" />
                </td>
                <td>
                    <input class="button action" type="submit" value="Submit" />
                </td>
            </tr>
        </table>
    </form>
    <br />
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 15%;">Kép</th>
                <th style="width: 20%;">Cím</th>
                <th style="width: 15%;">Oldal URL</th>
                <th style="width: 15%;">Shortcode</th>
                <th style="width: 15%;">Kattintások száma</th>
                <th style="width: 15%;">Dátum</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($myBannerDb as $value) : ?>
            <tr>
                <td><?php echo $value->id ?></td>
                <td>
                    <img style="max-width: 100%; width: auto; height: 100px;" src="<?php echo $value->imgLink ?>" />
                </td>
                <td><?php echo $value->title ?></td>
                <td><?php echo $value->pageLink ?></td>
                <td>
                    <input type="text" name="myBannerShortcode" id="myBannerShortcode" value="[myBanner id=<?php echo $value->id ?>]" />
                </td>
                <td><?php echo $value->clickCount ?></td>
                <td><?php echo $value->date ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <br />
    <input class="button action" type="submit" value="Mentés" />
    <input class="button button-primary button-large" type="submit" value="Törlés" />

</div>
