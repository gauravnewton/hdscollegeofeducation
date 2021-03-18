/*
 * Author: Gaurav Kumar
 * Date: 28 Dec 2019
 * Description:
 * main dashboard (script admin side)
 **/

$(function () {

  'use strict'

  // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999
  })
  $('.connectedSortable .card-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move')

  // jQuery UI sortable for the todo list
  $('.todo-list').sortable({
    placeholder         : 'sort-highlight',
    handle              : '.handle',
    forcePlaceholderSize: true,
    zIndex              : 999999
  })

  // bootstrap WYSIHTML5 - text editor
  $('.textarea').summernote()

  $('.daterange').daterangepicker({
    ranges   : {
      'Today'       : [moment(), moment()],
      'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month'  : [moment().startOf('month'), moment().endOf('month')],
      'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment().subtract(29, 'days'),
    endDate  : moment()
  }, function (start, end) {
    window.alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
  })

  /* jQueryKnob */
  $('.knob').knob()

  // jvectormap data
  // var visitorsData = {
  //   'US': 398, //USA
  //   'SA': 400, //Saudi Arabia
  //   'CA': 1000, //Canada
  //   'DE': 500, //Germany
  //   'FR': 760, //France
  //   'CN': 300, //China
  //   'AU': 700, //Australia
  //   'BR': 600, //Brazil
  //   'IN': 800, //India
  //   'GB': 320, //Great Britain
  //   'RU': 3000 //Russia
  // }
  // World map by jvectormap
  // $('#world-map').vectorMap({
  //   map              : 'usa_en',
  //   backgroundColor  : 'transparent',
  //   regionStyle      : {
  //     initial: {
  //       fill            : 'rgba(255, 255, 255, 0.7)',
  //       'fill-opacity'  : 1,
  //       stroke          : 'rgba(0,0,0,.2)',
  //       'stroke-width'  : 1,
  //       'stroke-opacity': 1
  //     }
  //   },
  //   series           : {
  //     regions: [{
  //       values           : visitorsData,
  //       scale            : ['#ffffff', '#0154ad'],
  //       normalizeFunction: 'polynomial'
  //     }]
  //   },
  //   onRegionLabelShow: function (e, el, code) {
  //     if (typeof visitorsData[code] != 'undefined')
  //       el.html(el.html() + ': ' + visitorsData[code] + ' new visitors')
  //   }
  // })

  // Sparkline charts
  // var sparkline1 = new Sparkline($("#sparkline-1")[0], {width: 80, height: 50, lineColor: '#92c1dc', endColor: '#ebf4f9'});
  // var sparkline2 = new Sparkline($("#sparkline-2")[0], {width: 80, height: 50, lineColor: '#92c1dc', endColor: '#ebf4f9'});
  // var sparkline3 = new Sparkline($("#sparkline-3")[0], {width: 80, height: 50, lineColor: '#92c1dc', endColor: '#ebf4f9'});

  // sparkline1.draw([1000, 1200, 920, 927, 931, 1027, 819, 930, 1021]);
  // sparkline2.draw([515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921]);
  // sparkline3.draw([15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21]);

  // The Calender
  $('#calendar').datetimepicker({
    format: 'L',
    inline: true
  })

  // SLIMSCROLL FOR CHAT WIDGET
  $('#chat-box').overlayScrollbars({
    height: '250px'
  })

})


/* student registration form validation script */
$(document).ready(function(){
        
  $.validator.setDefaults({
  errorClass: 'text-danger',
  highlight: function(element) {
      $(element)
      .closest('.form-control')
      .addClass('is-invalid');
  },
  unhighlight: function(element) {
      $(element)
      .closest('.form-control')
      .removeClass('is-invalid');
  }
  });

  $.validator.addMethod('strongPassword', function(value, element) {
  return this.optional(element) 
      || value.length >= 6
      && /\d/.test(value)
      && /[a-z]/i.test(value);
  }, 'Your password must be at least 6 characters long and contain at least one number and one char\'.')

  

  $("#brand-template-form").validate({
    rules: {        
      fileFormat: {
          required: true
      },
      template: {
          required: true
      },
    },
    messages: {
      fileFormat: {
          required: 'Please choose a file format first'
        },
        template: {
            required: 'Please upload a template file for this brand first'
        }
      }
  });

    

  $("#uploadDocument").validate({
      rules: {
          
        brand: {
          required :true
        },
        brandFile: {
          required :true
        }
      },
      messages: {
        brand: {
          required: 'Please choose brand first'
          },
        brandFile:{
          required: 'Please choose brand file first'
          }
        }
    });

    
  
    
  $("#brand-registration-edit").validate({
      rules: {
          brandName: {
              required: true
          },
          country: {
              required: true
          },
          email: {
              required: true
          },
          telephone: {
              required :true
          },
          creationDate: {
            required :true
          },
          tags: {
            required :true
          },
          commercialCategory: {
            required :true
          },
          eduCategory: {
            required :true
          },
          homeCategory: {
            required :true
          }
      },
      messages: {
        brandName :{
          required : 'Please enter brand name first'
        },
        country: {
            required: 'Please map corresponding country column in uploaded templte first'
        },
        email: {
            required: 'Please map corresponding email column in uploaded template first'
        },
        telephone: {
            required :'Please map corresponding telephone column in uploaded template first'
        },
        creationDate: {
          required : 'Please map corresponding creating date column in uploaded template first'
        },
        tags: {
          required : 'Please enter tags first'
        },
        commercialCategory: {
          required : 'Please enter commercial category first'
        },
        eduCategory: {
          required : 'Please enter edu category first'
        },
        homeCategory: {
              required: 'Please enter home category first'
          }
      }
  });

      

  $("#brand-registration").validate({
    rules: {
        brandName: {
            required: true
        },
        country: {
            required: true
        },
        email: {
            required: true
        },
        telephone: {
            required :true
        },
        creationDate: {
          required :true
        },
        tags: {
          required :true
        },
        commercialCategory: {
          required :true
        },
        eduCategory: {
          required :true
        },
        homeCategory: {
          required :true
        },
        firstName: {
          required: true
        }
    },
    messages: {
      brandName :{
        required : 'Please enter brand name first'
      },
      country: {
          required: 'Please map corresponding country column in uploaded templte first'
      },
      email: {
          required: 'Please map corresponding email column in uploaded template first'
      },
      telephone: {
          required :'Please map corresponding telephone column in uploaded template first'
      },
      creationDate: {
        required : 'Please map corresponding creating date column in uploaded template first'
      },
      tags: {
        required : 'Please enter tags first'
      },
      commercialCategory: {
        required : 'Please enter commercial category first'
      },
      eduCategory: {
        required : 'Please enter edu category first'
      },
      homeCategory: {
            required: 'Please enter home category first'
        },
        firstName: {
          required: 'Please enter first Name first'
        }
    }
  });



  $("#user-registration").validate({
    rules: {
        fullName: {
            required: true
        },
        password: {
            required: true,
            strongPassword: true
        },
        conf_password: {
            required: true,
            equalTo: '#password'
        },
        email: {
            required: true,
            email: true
        },
        role: {
            required: true
        },
        apiKey: {
            required :true
        }
    },
    messages: {
      email: {
          required: 'Please enter an email address.',
          email: 'Please enter a valid email address.'
      }
    }
  });

  $("#add-keywords").validate({
    rules: {        
      category: {
          required: true
      },
      keyword: {
          required: true
      },
    },
    messages: {
      category: {
          required: 'Please choose a category first'
        },
        keyword: {
            required: 'Please fill keyword first'
        }
      }
  });
});