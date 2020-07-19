// HIDDEN AND SHOW NAVBAR
  var prev = 0;
  var $window = $( window );
  var nav = $( '.navbar' );
  $( window ).on( "load resize scroll", _.throttle( function( e ) {
    var scrollTop = $( this ).scrollTop();
    // console.log( scrollTop > prev )
    ( scrollTop > prev )
    nav.toggleClass( 'affix', scrollTop > prev );
    prev = scrollTop;
  }, 100 ) );  