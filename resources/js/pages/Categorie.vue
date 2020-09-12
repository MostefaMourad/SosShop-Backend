<template>
<v-container>
  <!-- <v-data-table
    :headers="headers"
    :items="users"
    sort-by="user_name"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat >
        <v-toolbar-title>Mes Utilisateurs</v-toolbar-title>
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
              <span class="headline"> Supprimer l'Utilisateur ? </span>
            </v-card-title>
            <v-card-text>
              Si vous poursuivez cette action, vous supprimerez un utilisateur de l'application mobile Tourathi, l'utilisateur n'aura pas accès à son compte, mais les données collectées auprès de l'utilisateur seront enregistrées .
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="#00adb5" text @click="close">Annuler</v-btn>
              <v-btn color="red" text @click="save">Supprimer</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>  
    <template v-slot:no-data>
      <v-btn color="#00adb5" @click="initialize">Reset</v-btn>
    </template>
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
  </v-data-table>-->
</v-container>
</template>

<script>
import axios from 'axios';

  export default {
    data: () => ({
      headers : [
       {text:'User Name',align :'left',value:'user_name'},
       {text:'Age',align :'left',value:'age'},
       {text:'Lieu Residence',align :'left',sortable:false,value:'lieu_residence'},
       {text:'Sexe',align :'left',value:'sexe'},
       {text:'Nombre de Markers Crées',align :'left' ,value:'marker'},
       {text: 'Actions',align :'center', value: 'actions', sortable: false}
     ] ,
      users: [],
      dialog: false,
      on:null,
      attrs:null,
      index:0,
      defaultItem: {
        user_name:"",
        age:0,
        lieu_residence:"",
        sexe:false,
        marker:0,
      },
    }),
    created () {
     // this.initialize()
    },

    methods: {
     
    },
  }
</script>