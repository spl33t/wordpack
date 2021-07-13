import Flickity from 'flickity'
import Post from '@js/Post'
import scss from '@css/scss.scss'

const post = new Post('Webpack Title');

console.log(post.toString());

var flky = new Flickity( '.gallery', {
    cellAlign: 'left',
    contain: true,
    freeScroll: true,
    prevNextButtons: false,
    pageDots: false
});