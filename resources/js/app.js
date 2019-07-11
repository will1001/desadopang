
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
var Vue = require('vue');
Vue.use(require('vue-resource'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('bidangpemerintahan', require('./components/BidangPemerintahan.vue'));
// Vue.component('example', require('./components/ExampleComponent.vue'));
// Vue.component('tabeldatapenduduk', require('./components/admincomponent/TabelDataPenduduk.vue'));


import tabeldatapenduduk from './components/admincomponent/TabelDataPenduduk.vue';
import buatsurat from './components/admincomponent/BuatSurat.vue';
import tabelakunlogindesa from './components/admincomponent/TabelAkunLoginDesa.vue';
import tabelberita from './components/admincomponent/TabelBerita.vue';
import tabelpengumuman from './components/admincomponent/TabelPengumuman.vue';
import tabelSOTK from './components/admincomponent/TabelSOTK.vue';
import icondown from './components/admincomponent/IconDown.vue';
import iconup from './components/admincomponent/IconUp.vue';


import indexpage from './components/indexcomponent/IndexPage.vue';
import selayangpandang from './components/indexcomponent/SelayangPandang.vue';
import bidangpemerintahan from './components/indexcomponent/BidangPemerintahan.vue';
import panduanpenduduk from './components/indexcomponent/PanduanPenduduk.vue';
import halamanbisnis from './components/indexcomponent/HalamanBisnis.vue';
import untukpengunjung from './components/indexcomponent/UntukPengunjung.vue';
import lembagaindex from './components/indexcomponent/LembagaIndex.vue';
import agenda from './components/indexcomponent/Agenda.vue';
import datadesa from './components/indexcomponent/DataDesa.vue';
import barchartcomponent from './components/indexcomponent/BarChartComponent.vue';
import piechartcomponent from './components/indexcomponent/PieChartComponent.vue';
import linechartcomponent from './components/indexcomponent/LineChartComponent.vue';







Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');



const app = new Vue({
    el: '#app',
    components : { 
      tabeldatapenduduk,
      buatsurat,
      tabelakunlogindesa,
      tabelberita,
      tabelpengumuman,
      tabelSOTK,
      icondown,
      iconup, 
      indexpage,
      selayangpandang,
      bidangpemerintahan,
      panduanpenduduk,
      halamanbisnis,
      untukpengunjung,
      lembagaindex,
      agenda,
      datadesa,
      barchartcomponent,
      piechartcomponent,
      linechartcomponent,
    },
    data:{
      currentComponent : "",
      currentIcon : "icondown",
    	currentchart : "barchartcomponent",
      active_el : 1,
      active_el_index : 0,
      currentView : "indexpage",
      isHidden : false,
    },
    methods: {
    swapIcon: function()
    {
        if(this.currentIcon=="icondown"){
          this.currentIcon = "iconup";
          console.log(this.currentIcon);
        }else{
          this.currentIcon = "icondown";
          console.log(this.currentIcon);
        }
    }
    ,swapComponent: function(component)
    {
      this.currentComponent = component;
    },
     activate:function(el){
        this.active_el = el;
    }
    ,active_index:function(el){
        this.active_el_index = el;
    },
    updatecurrentview:function(el){
        this.currentView = el;
    },
    gantichart:function(el){
        this.currentchart = el;
    },
  }
});
