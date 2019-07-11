<template>
<div class="container" style="padding-top: 40px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="kotakagenda">
                        <h1 class="text-center">Agenda Desa</h1>
                          <div style="overflow: auto;max-height: 400px;position: relative;margin: 5px 25px;">
                            <table>
                            <thead>
                              <col width="1000px">
                              <col width="1000px">
                              <col width="1000px">
                              <tr>
                                        <th>No</th>
                                        <th>Nama Agenda</th>
                                        <th>Tanggal</th>
                              </tr>
                            </thead>
                            <tbody id="tbodytabel">
                              <tr v-for="agenda in agendas">
                                <td>1</td>
                                <td>{{agenda['agenda']}}</td>
                                <td>{{agenda['tgl_agenda']}}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return{
                agendas:[],
            }
        },
        created(){
            this.fetchagendas();
        },
        methods:{
            fetchagendas(){
                this.$http.get("dataagenda").then(response => {this.agendas = response.data.agendas});
            },
        }
    }
</script>
