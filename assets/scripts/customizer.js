(function( $ ) {

	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	//Update site title color in real time...
		wp.customize( 'header_textcolor', function( value ) {
			value.bind( function( to ) {
				$('#navbar-main a.navbar-brand.site-title').css('color', to );
			} );
		} );

    wp.customize( 'header_textcolor', function( value ) {
        value.bind( function( to ) {
            if ( 'blank' === to ) {
                $( '.site-title, .site-description' ).css( {
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                } );
            } else {
                $( '.site-title, .site-description' ).css( {
                    'clip': 'auto',
                    'position': 'static'
                } );

                $( '.site-title a' ).css( {
                    'color': to
                } );
            }
        } );
    });

    wp.customize( 'wpt_logo', function( value ) {
        value.bind( function( to ) {
            if( to == '' ) {
                $(' #logo ').hide();
            } else {
                $(' #logo ').show();
                $(' #logo ').attr( 'src', to );
            }
        } );
    });
		wp.customize( 'wpt_custom_home_image', function( value ) {
        value.bind( function( to ) {
            if( to == '' ) {
                $(' #bckimgcust ').show();
            } else {
                $(' #bckimgcust ').show();
                $(' #bckimgcust ').attr( 'src', to );
            }
        } );
    });

    wp.customize( 'wpt_footer_text', function( value ) {
        value.bind( function( to ) {
            if( to == '' ) {
                $(' #footertext ').show();
								$(' #footertext ').html();
            } else {
								$(' #footertext ').show();
                $(' #footertext ').html( to );
            }
        } );
    });
		wp.customize( 'wpt_b_color', function( value ) {
        value.bind( function( to ) {
            $( 'p' ).css( 'color', to );
        } );
    });

    wp.customize( 'wpt_b_font_size', function( value ) {
        value.bind( function( to ) {
            $( 'p' ).css( 'font-size', to + 'em' );
        } );
    });
    wp.customize( 'wpt_HS1_color', function( value ) {
        value.bind( function( to ) {
            $( 'h1' ).css( 'color', to );
        } );
    });

    wp.customize( 'wpt_h1_font_size', function( value ) {
        value.bind( function( to ) {
            $( 'h1' ).css( 'font-size', to + 'em' );
        } );
    });
		wp.customize( 'wpt_h2_color', function( value ) {
        value.bind( function( to ) {
            $( 'h2' ).css( 'color', to );
        } );
    });

    wp.customize( 'wpt_h2_font_size', function( value ) {
        value.bind( function( to ) {
            $( 'h2' ).css( 'font-size', to + 'em' );
        } );
    });
		wp.customize( 'wpt_h3_color', function( value ) {
        value.bind( function( to ) {
            $( 'h3' ).css( 'color', to );
        } );
    });

    wp.customize( 'wpt_h3_font_size', function( value ) {
        value.bind( function( to ) {
            $( 'h3' ).css( 'font-size', to + 'em' );
        } );
    });
		wp.customize( 'wpt_h4_color', function( value ) {
        value.bind( function( to ) {
            $( 'h4' ).css( 'color', to );
        } );
    });

    wp.customize( 'wpt_h4_font_size', function( value ) {
        value.bind( function( to ) {
            $( 'h4' ).css( 'font-size', to + 'em' );
        } );
    });
		wp.customize( 'wpt_h5_color', function( value ) {
        value.bind( function( to ) {
            $( 'h5' ).css( 'color', to );
        } );
    });

    wp.customize( 'wpt_h5_font_size', function( value ) {
        value.bind( function( to ) {
            $( 'h5' ).css( 'font-size', to + 'em' );
        } );
    });
		wp.customize( 'wpt_h6_color', function( value ) {
        value.bind( function( to ) {
            $( 'h6' ).css( 'color', to );
        } );
    });

    wp.customize( 'wpt_h6_font_size', function( value ) {
        value.bind( function( to ) {
            $( 'h6' ).css( 'font-size', to + 'em' );
        } );
    });
		wp.customize( 'wpt_pre_color', function( value ) {
        value.bind( function( to ) {
            $( 'pre' ).css( 'color', to );
        } );
    });
    wp.customize( 'wpt_pre_font_size', function( value ) {
        value.bind( function( to ) {
            $( 'pre' ).css( 'font-size', to + 'em' );
        } );
    });

})( jQuery );
