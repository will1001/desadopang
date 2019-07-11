<template>
	<download-excel
    class   = "btn btn-default"
    :data   = "json_data"
    worksheet = "My Worksheet"
    name    = "Data.xls">
 
    Download data Excel
 
</download-excel>
</template>

<script>
	import Vue from 'vue';
	import JsonExcel from 'vue-json-excel';
 
Vue.component('downloadExcel', JsonExcel);

    export default {
        mounted() {
            console.log('Component mounted.')
            this.$http.get("databerita").then(response => {this.json_data = response.data.beritas});
        },
        data() {
        	return {
        		json_fields: {
            'Complete name': 'name',
            'City': 'city',
            'Telephone': 'phone.mobile',
            'Telephone 2' : {
                field: 'phone.landline',
                callback: (value) => {
                    return `Landline Phone - ${value}`;
                }
            },
        },
        json_data: [],
        json_meta: [
            [
                {
                    'key': 'charset',
                    'value': 'utf-8'
                }
            ]
        ],
            }  
      }
    }
</script>
