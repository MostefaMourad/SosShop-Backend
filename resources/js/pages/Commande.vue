<template>
<v-container>
  <v-data-table
    :headers="headers"
    :items="commandes"
    sort-by="id"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat >
        <v-toolbar-title> Les Commandes Dans les Paniers (Pas finalisé)  </v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical 
        ></v-divider>
      </v-toolbar>
    </template>
    <template v-slot:no-data>
      <v-btn color="#00adb5" @click="initialize()">Reset</v-btn>
    </template>
  </v-data-table>
</v-container>
</template>

<script>
import axios from 'axios';

  export default {
    data: () => ({
      headers : [
       {text:'Numéro de la commande',align :'left',value:'id'},
       {text:'Quantité',align :'left' , value:'quantite',sortable: false},
       {text:'Nom Client',align :'left' , value:'nom'},
       {text:'Prénom Client',align :'left' , value:'prenom'},
       {text:'Le Coût',align :'left' , value:'prix'},
     ] ,
      commandes: [],
      dialog:false,
      index:-1,
      defaultItem: {
        id:0,
        quantite:0,
        nom:"",
        prenom:"",
        prix:0.0,
      },
    }),
    created () {
      this.initialize();
    },
    methods: {
      initialize () {
          let obj = this;
          axios.get(`http://127.0.0.1:8000/api/commande`)
          .then(function (response) {
            obj.commandes = response.data.data;
          })
          .catch(function (error) {  
          console.log(error);
          });
      },
    },
  }
</script>

<style scoped>

</style>