<template>
<v-container>
  <v-data-table
    :headers="headers"
    :items="markers"
    sort-by="name"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat >
        <v-toolbar-title>Mes Markers</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <v-spacer></v-spacer>
        <v-dialog light v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="#00adb5"
              dark
              class="mb-2"
              v-bind="attrs"
              v-on="on"
            >Nouveau Marker </v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }} </span>
            </v-card-title>

            <v-card-text>
                <v-row>
                  <v-col>
                    <v-text-field color="#00adb5" v-model="editedItem.name" label="Marker Name"></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-textarea
                        v-model="editedItem.description"
                        label="Description"
                        counter
                        color="#00adb5"
                      >
                      </v-textarea>
                  </v-col>
                    <v-col cols="12" md="6">
                    <v-text-field color="#00adb5"  type="number" v-model="editedItem.longitude" label="Longitude"></v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                      <v-text-field color="#00adb5" type="number" v-model="editedItem.latitude" label="Latitude"></v-text-field>
                    </v-col>
                  <div>
                  </div>
                  <v-col>
                    <v-file-input
                      :rules="rules"
                      accept="image/png, image/jpeg, image/bmp"
                      label="Image Marker"
                      prepend-icon="mdi-camera"
                      color="#00adb5"
                      v-model="editedItem.image"
                      v-show="edit"
                    ></v-file-input>
                  </v-col>
                </v-row>
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="#00adb5" text @click="close">Cancel</v-btn>
              <v-btn color="#00adb5" text @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog light v-model="dialog1" max-width="300px">
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
              <span class="headline"> Supprimer le Marker ? </span>
            </v-card-title>
            <v-card-text>
              Si vous poursuivez cette action, vous supprimerez le marqueur, ainsi toutes les opinions, images et réponses associées seront également supprimées.
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="#00adb5" text @click="close">Annuler</v-btn>
              <v-btn color="red" text @click="delet">Supprimer</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>   
      </v-toolbar>
    </template>
    <template block v-slot:item.actions="{ item }">
      <v-row>
               <v-icon
        medium
        class="mr-2"
        color="#00adb5"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        medium
        @click="deleteItem(item)"
        color="red"
      >
        mdi-delete
      </v-icon>
      </v-row>
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
       {text:'Marker Name',align :'left',value:'name'},
       {text:'Description',align :'left',sortable:false,value:'description'},
       {text:'Latitude',align :'left',value:'latitude'},
       {text:'Longitude',align :'left',value:'longitude'},
       {text:'Marker Rating',align :'left' , value:'rating'},
       {text:'Admin Marker',align :'left' , value:'is_admin'},
       {text:'Actions',align :'center', value: 'actions', sortable: false}
     ] ,
     rules: [
        value => !value || value.size < 2000000 || 'Image size should be less than 2 MB!',
      ],
      markers: [],
      dialog:false,
      dialog1:false,
      edit:true,
      formTitle:"Nouveau Marker",
      editedItem: {
        name:"",
        description:"",
        latitude:0,
        longitude:0,
        rating:0,
        image:null,
        is_admin:true
      },
      defaultItem: {
        name:"",
        description:"",
        latitude:0,
        longitude:0,
        rating:0,
        image:null,
        is_admin:true
      },
    }),
    created () {
      this.initialize()
    },

    methods: {
      initialize () {
          let obj = this;
          axios.get(`https://tourathi-dz.com/api/admin/markers`)
          .then(function (response) {
          obj.markers = response.data;
          })
          .catch(function (error) {  
          console.log(error);
          }); 
      },
      deleteItem (item) {
        this.dialog1 = true ;
        this.index = this.markers.indexOf(item);
      },
      close(){
        this.dialog1 = false;
        this.dialog = false;
        let obj = this ;
        if(obj.edit == false){
          obj.markers[obj.index].name = obj.editedItem.name;
          obj.markers[obj.index].description = obj.editedItem.description;
          obj.markers[obj.index].latitude = obj.editedItem.latitude;
          obj.markers[obj.index].longitude = obj.editedItem.longitude;
          obj.edit = true;
        }
        this.editedItem = Object.assign({}, this.defaultItem);
        this.formTitle = "Nouveau Marker";
      },
      save(){

        let obj = this;
        
        if(this.edit === false){
          axios.patch(`https://tourathi-dz.com/api/admin/markers/update/${obj.markers[obj.index].id}`,obj.editedItem)
          .then(function (response) {
          console.log(response.data);
          })
          .catch(function (error) {    
          console.log(error);
          });
        }
        else{
          const formData = new FormData();
          let confirmed = true;
          let error = '';
          formData.append('name',obj.editedItem.name);
          formData.append('description',obj.editedItem.description);
          formData.append('latitude',obj.editedItem.latitude);
          formData.append('longitude',obj.editedItem.longitude);
          if(obj.editedItem.image!=null){
            formData.append('image',obj.editedItem.image);
          }
          if(obj.editedItem.name==''){
             error += 'Le nom du marqueur n\'est pas valide \n';
             confirmed = false;
          }
          if(obj.editedItem.description==''){
             error += 'La description du marqueur n\'est pas valide \n';
             confirmed = false; 
          }
          if(obj.editedItem.latitude==0){
             error += 'Latitude  n\'est pas valide \n';
             confirmed = false;
          }
          if(obj.editedItem.longitude==0){
             error += 'Longitude n\'est pas valide \n';
             confirmed = false;
          }
          if(confirmed){
          axios.post(`https://tourathi-dz.com/api/admin/markers/store`,formData)
          .then(function (response) {
          obj.markers.push(response.data);
          console.log(response.data);
          })
          .catch(function (error) {    
          console.log(error.response.data.errors);
          });
          }
          else{
            window.alert(error);
          }
        }
        this.close();
      },
      delet(){
        this.dialog1 = true;
        let obj = this;
          axios.delete(`https://tourathi-dz.com/api/admin/markers/delete/${obj.markers[obj.index].id}`)
          .then(function (response) {
          console.log(response.data);
          obj.markers.splice(obj.index, 1);
          })
          .catch(function (error) {    
          console.log(error);
          });
        this.dialog1 = false;
      },
      editItem(item){
        this.edit=false;
        this.formTitle="Modifier Marker";
        this.index = this.markers.indexOf(item);
        this.editedItem = Object.assign({}, item);
        this.dialog = true;
      }
    },
  }
</script>