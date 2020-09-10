<template>
<v-container>
  <v-data-table
    :headers="headers"
    :items="avis"
    sort-by="commentaire"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat >
        <v-toolbar-title>Les Avis</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
          <v-dialog light v-model="dialog" max-width="300px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="#00adb5"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
              v-show="false"
            ></v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline"> Supprimer l'Avis ? </span>
            </v-card-title>
            <v-card-text>
              Si vous poursuivez cette action, vous supprimerez un avis, ainsi, toutes les réponses et images associées seront également supprimées .
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="#00adb5" text @click="close">Annuler</v-btn>
              <v-btn color="red" text @click="save">Supprimer</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog> 
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        medium
        @click="deleteItem(item)"
        color="red"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="#00adb5" @click="initialize">Reset</v-btn>
    </template>
  </v-data-table>
</v-container>
</template>

<script>
import axios from 'axios';

  export default {
    data: () => ({
      headers : [
       {text:'Commentaire',align :'left',value:'commentaire'},
       {text:'Rating',align :'left',value:'rating'},
       {text:'Likes',align :'left',value:'likes'},
       {text:'Réponses',align :'left',value:'comments'},
       {text:'Utilisateur',align :'left' , value:'user'},
       {text: 'Actions',align :'center', value: 'actions', sortable: false}
     ] ,
      avis: [],
      dialog:false,
      defaultItem: {
        commentaire:"",
        rating:0,
        likes:0,
        comments:0,
        user:"",
      },
    }),
    created () {
      this.initialize()
    },

    methods: {
      initialize () {
          let obj = this;
          axios.get(`https://tourathi-dz.com/api/admin/avis`)
          .then(function (response) {
            obj.avis = response.data;
          })
          .catch(function (error) {  
          console.log(error);
          }); 
      },
      deleteItem (item) {
        this.dialog = true ;
        this.index = this.avis.indexOf(item);
      },
      close(){
        this.dialog = true;
        this.dialog = false;
      },
      save(){
        this.dialog = true;
        let obj = this;
          axios.delete(`https://tourathi-dz.com/api/admin/avis/delete/${obj.avis[obj.index].id}`)
          .then(function (response) {
          console.log(response.data);
          obj.avis.splice(obj.index, 1);
          })
          .catch(function (error) {    
          console.log(error);
          });
        this.dialog = false;
      }
    },
  }
</script>