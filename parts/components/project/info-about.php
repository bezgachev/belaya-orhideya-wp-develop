<?if(!defined('ABSPATH')){exit;}
$svg_0 = '<svg width="100" height="90" viewBox="0 0 100 90" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M47.7434 2.04949C56.7232 2.70969 62.0283 11.8036 69.3549 16.9899C76.7653 22.2355 86.3303 24.7551 90.8698 32.5776C95.9487 41.3294 99.1072 52.4023 95.3513 61.7867C91.6439 71.0501 80.9977 75.0564 72.0486 79.605C64.4043 83.4903 56.3332 85.8183 47.7434 85.9842C38.9989 86.153 30.2405 85.0141 22.7399 80.5571C14.7416 75.8044 6.96109 69.2887 4.60171 60.3489C2.28787 51.5815 7.15556 42.9 10.5844 34.4987C13.7605 26.7166 17.3127 19.1815 23.6687 13.631C30.529 7.64031 38.6238 1.37901 47.7434 2.04949Z" fill="#F7F6FC"></path></svg>';
$svg_1 = '<svg width="100" height="90" viewBox="0 0 100 90" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M52.2566 2.04949C43.2768 2.70969 37.9717 11.8036 30.6451 16.9899C23.2347 22.2355 13.6697 24.7551 9.13018 32.5776C4.05135 41.3294 0.892828 52.4023 4.64865 61.7867C8.35607 71.0501 19.0023 75.0564 27.9514 79.605C35.5957 83.4903 43.6668 85.8183 52.2566 85.9842C61.0011 86.153 69.7595 85.0141 77.2601 80.5571C85.2584 75.8044 93.0389 69.2887 95.3983 60.3489C97.7121 51.5815 92.8444 42.9 89.4156 34.4987C86.2395 26.7166 82.6873 19.1815 76.3313 13.631C69.471 7.64031 61.3762 1.37901 52.2566 2.04949Z" fill="#F7F6FC"></path></svg>';
$svg_2 = '<svg width="100" height="90" viewBox="0 0 100 90" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M46.5655 2.04949C56.1247 2.70969 61.772 11.8036 69.5713 16.9899C77.4598 22.2355 87.6419 24.7551 92.4743 32.5776C97.8808 41.3294 101.243 52.4023 97.245 61.7867C93.2984 71.0501 81.9653 75.0564 72.4388 79.605C64.3014 83.4903 55.7095 85.8183 46.5655 85.9842C37.2569 86.153 27.9335 85.0141 19.949 80.5571C11.4346 75.8044 3.15213 69.2887 0.640535 60.3489C-1.82259 51.5815 3.35914 42.9 7.00918 34.4987C10.3902 26.7166 14.1716 19.1815 20.9377 13.631C28.2405 7.64031 36.8576 1.37901 46.5655 2.04949Z" fill="#F7F6FC"></path></svg>';
$key = $args['key'];
$svg = ($key == 0) ? $svg_0 : (($key == 1) ? $svg_1 : $svg_2);
?>
<div class="info-about__item">
    <div class="info-about__item_img">
        <?=$svg;?>
        <p><?=$args['title'];?></p>
    </div>
    <p><?=$args['subtitle'];?></p>
</div>