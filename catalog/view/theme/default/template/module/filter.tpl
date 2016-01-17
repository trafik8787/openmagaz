<div class="panel panel-default">
  <div class="panel-heading"><?php echo $heading_title; ?></div>
  <div class="list-group">
    <?php foreach ($filter_groups as $filter_group):?>
      <a class="list-group-item"><?php echo $filter_group['name']; ?></a>

      <?php if (!empty($filter_group['filter'])):?>

        <div class="list-group-item">
          <div id="filter-group<?php echo $filter_group['filter_group_id']; ?>">
            <?php foreach ($filter_group['filter'] as $filter): ?>
              <div class="checkbox">
                <label>
                  <?php if (in_array($filter['filter_id'], $filter_category)) { ?>
                  <input type="checkbox" name="filter[]" value="<?php echo $filter['filter_id']; ?>" checked="checked" />
                  <?php echo $filter['name']; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="filter[]" value="<?php echo $filter['filter_id']; ?>" />
                  <?php echo $filter['name']; ?>
                  <?php } ?>
                </label>
              </div>
            <?php endforeach ?>
          </div>
        </div>

      <?php endif?>


      <?php if (!empty($filter_group['dop_filter'])):?>

        <div class="list-group-item">
          <div id="filter-group<?php echo $filter_group['filter_group_id']; ?>">

            <div id="slider"></div>
            <div class="row" style="margin-top: 10px">
              <div class="col-md-6">
                <input type="text" class="dop-filtr-price-min form-control" name="min_price" value="<?php if (!empty($PriceFrom)) { echo $PriceFrom; } else { echo $filter_group['dop_filter']['min']; }?>">
              </div>
              <div class="col-md-6 text-right">
                <input type="text" class="dop-filtr-price-max form-control" name="max_price" value="<?php if (!empty($PriceTo)) { echo  $PriceTo; } else { echo $filter_group['dop_filter']['max']; }?>">
              </div>
            </div>
          </div>
        </div>

      <?php endif?>


    <?php endforeach?>
  </div>
  <div class="panel-footer text-right">
    <button type="button" id="button-filter" class="btn btn-primary"><?php echo $button_filter; ?></button>
  </div>
</div>
<script type="text/javascript">
  $(function(){

    var filter = [];
    var redirect;

    //поиск
    $('#button-filter').on('click', function() {

        var max_price = '';
        var min_price = '';

        $('input[name^=\'filter\']:checked').each(function(element) {
            filter.push(this.value);
        });

        if ($('input[name=\'min_price\']').val() != '' && $('input[name=\'min_price\']').val() != undefined) {
          min_price = '&PriceFrom=' + $('input[name=\'min_price\']').val();
        }

        if ($('input[name=\'max_price\']').val() != '' && $('input[name=\'max_price\']').val() != undefined) {
          max_price = '&PriceTo=' + $('input[name=\'max_price\']').val();
        }


        location = '<?php echo $action; ?>&filter=' + filter.join(',')+min_price+max_price;

    });


    $('input[name^=\'filter\']').on('change', function(){
      filter= [];
      $('input[name^=\'filter\']:checked').each(function(element) {
        filter.push(this.value);
      });

      var action = '<?php echo $action; ?>';
      redirect = action+'&filter=' + filter.join(',');
      history.pushState('', '', redirect);


//      $.ajax({ // описываем наш запрос
//        type: "GET", // будем передавать данные через POST
//        dataType: "HTML", // указываем, что нам вернется JSON
//        url: '/?route=product/ajax',
//        data: '&filter=' + filter.join(','), // передаем данные из формы
//        success: function(response) { // когда получаем ответ
//          console.log(response);
//        }
//      });

    });


  var min = <? echo !empty($filter_group['dop_filter']['min']) ? $filter_group['dop_filter']['min'] : 0 ?>;
  var max = <? echo !empty($filter_group['dop_filter']['max']) ? $filter_group['dop_filter']['max'] : 0 ?>;


  var ValMin = $('.dop-filtr-price-min').val();
  var ValMax = $('.dop-filtr-price-max').val();

  var slider = $("#slider").slider({
    range: true,
    min: min,
    animate: 'slow',
    step: 1,
    max: max,
//    values: [$('.dop-filtr-price-min').val(), $('.dop-filtr-price-max').val()],
    values: [ValMin, ValMax],
    slide: function( event, ui ) {
      $('.dop-filtr-price-max').val(ui.values[1]);
      $('.dop-filtr-price-min').val(ui.values[0]);
    },
    stop: function( event, ui ) {

        //console.log(ui);

//      $.ajax({ // описываем наш запрос
//        type: "GET", // будем передавать данные через POST
//        dataType: "JSON", // указываем, что нам вернется JSON
//        url: '/subscribe_enable',
//        data: $(form).serialize(), // передаем данные из формы
//        success: function(response) { // когда получаем ответ
//          console.log(response);
//        }
//      });
    }
  });

  $('.dop-filtr-price-max').on('change', function(){
    slider.slider("values", 1, $(this).val());
  });

  $('.dop-filtr-price-min').on('change', function(){
    slider.slider("values", 0, $(this).val());
  });

});

</script>
