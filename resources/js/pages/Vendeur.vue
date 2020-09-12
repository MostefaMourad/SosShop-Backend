<template>
<v-container>
  <v-data-table
    :headers="headers"
    :items="vendeurs"
    sort-by="nom"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat >
        <v-toolbar-title>Les Clients de Sos Shop (vendeurs) </v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical 
        ></v-divider>
        <v-spacer></v-spacer>
          <v-dialog light v-model="dialog" max-width="300px">
          <template>
            <v-btn
              color="#00adb5"
              dark
              class="mb-2"
              v-show="false"
            ></v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline"> Supprimer le Client (l'Acheteur) ? </span>
            </v-card-title>
            <v-card-text>
              Si vous poursuivez cette action, vous supprimerez un client Sos Shop , ainsi, toutes les commandes associées seront également supprimées , de plus l'utilisateur n'aura plus accés a son compte .
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="grey" text @click="save()" >Annuler</v-btn>
              <v-btn color="red" text @click="del()" >Supprimer</v-btn>
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
       {text:'Boutique',align :'left' , value:'nom_boutique'},
       {text:'Nom',align :'left',value:'nom'},
       {text:'Prénom',align :'left',value:'prenom'},
       {text:'Email',align :'left',value:'email'},
       {text:'Téléphone',align :'left',value:'telephone',sortable: false},
       {text:'Adresse',align :'left' , value:'adresse',sortable: false},
       {text:'Description',align :'left',value:'description',sortable: false},      
       {text:'Actions',align :'center', value: 'actions', sortable: false}
     ] ,
      vendeurs: [],
      dialog:false,
      index:-1,
      defaultItem: {
        nom:"",
        prenom:"",
        email:"",
        telephone:"",
        telephone_sup:"",
        region:"",
        ville:"",
        adresse:"",
        date_naissance:""
      },
    }),
    created () {
      this.initialize();
    },
    methods: {
      initialize () {
          let obj = this;
          axios.get(`http://127.0.0.1:8000/api/vendeur`)
          .then(function (response) {
            obj.vendeurs = response.data.data;
          })
          .catch(function (error) {  
          console.log(error);
          });
      },
      deleteItem (item) {
        this.dialog = true ;
        this.index = this.vendeurs.indexOf(item);
      },
      save(){
        this.dialog = false ;
        this.index = -1;
      },
      del(){
        let obj = this;
        axios.delete(`http://127.0.0.1:8000/api/vendeur/delete/${obj.vendeurs[obj.index].id}`)
        .then(function (response) {
          console.log(response.data);
          obj.vendeurs.splice(obj.index, 1);
        })
        .catch(function (error) {  
        console.log(error);
        });
        obj.save();
      }
    },
  }
</script>