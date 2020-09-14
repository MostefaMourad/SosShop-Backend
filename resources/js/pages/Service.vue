<template>

  <v-data-table
    :headers="headers"
    :items="services"
    sort-by="partenaire"
    class="elevation-1"
  >

    <template v-slot:top>

      <v-toolbar flat>

        <v-toolbar-title> Mes Services </v-toolbar-title>

        <v-divider
          class="mx-4"
          inset
          vertical
        >

        </v-divider>

        <v-spacer></v-spacer>

        <v-dialog v-model="dialog" max-width="450px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="#11999e"
              dark
              class="mb-2" 
              v-bind="attrs"
              v-on="on" 
            > Ajouter un service </v-btn>
          </template>

          <v-card light>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>
            <v-card-text>
              <v-text-field color="#11999e" outlined  v-model="editedItem.partenaire" label="Partenaire"></v-text-field>
              <v-text-field color="#11999e" outlined  v-model="editedItem.numero" label="Téléphone"></v-text-field>
              <v-text-field color="#11999e" outlined  v-model="editedItem.titre" label="Titre"></v-text-field>
              <v-text-field color="#11999e" outlined  v-model="editedItem.prix" label="Prix (DA)"></v-text-field>
                <v-textarea
                    outlined
                    clearable
                    counter
                    label="Déscription"
                    color="#11999e"
                    v-model="editedItem.description"
                ></v-textarea>
              <v-file-input
                color="#11999e"
                v-model="editedItem.image"
                accept="image/png, image/jpeg, image/bmp"
                placeholder="Choisir une photo"
                prepend-icon="mdi-camera"
                label="Photo du Service"
                v-show="editedIndex < 0"
              ></v-file-input>
            </v-card-text>
            <v-row>
              <v-col md="6" align="center">
                    <v-btn color="grey" text @click="close"> Annuler</v-btn>
              </v-col>
              <v-col md="6" align="center">
                    <v-btn color="#11999e" text @click="save">Sauvegarder</v-btn>
              </v-col>
            </v-row>
          </v-card>
        </v-dialog>

        <v-dialog light v-model="dialog1" max-width="400px">
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
              <span class="headline"> Supprimer le Service ? </span>
            </v-card-title>
            <v-card-text>
              Si vous poursuivez cette action, vous supprimerez le service définitivement .
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="grey" text @click="close()" >Annuler</v-btn>
              <v-btn color="red" text @click="del()" >Supprimer</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <v-dialog light v-model="dialog2" max-width="400px">
          <template>
            <v-btn
              color="#00adb5"
              dark
              class="mb-2"
              v-show="false"
            ></v-btn>
          </template>
          <v-card>
            &nbsp;&nbsp;&nbsp;&nbsp;
            <v-card-text>
              <img :src="imageUrl" alt="Profile Photo">
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="grey" text @click="close()" > Fermer </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
    <template v-slot:item.actions="{ item }">
      <v-icon
        medium
        color="primary"
        @click="viewImage(item)"
      >
        mdi-image-area
      </v-icon>
      <v-icon
        medium
        class="mr-2"
        color="#11999e"
        @click="editItem(item)"
      >
        mdi-pencil
      </v-icon>
      <v-icon
        medium
        color="red"
        @click="deleteItem(item)"
      >
        mdi-delete
      </v-icon>
    </template>
    <template v-slot:no-data>
      <v-btn color="#11999e" @click="initialize">Reset</v-btn>
    </template>
  </v-data-table>
</template>

<script>
import axios from 'axios'

  export default {
    data: () => ({
      dialog: false,
      dialog1:false,
      dialog2:false,
      headers: [
        { text: 'Préstateur de service', value: 'partenaire'},  
        {text: 'Nom du service',align: 'start',value: 'titre',},
        { text: 'Description', value: 'description'},
        { text: 'Téléphone', value: 'numero'},
        { text: 'Prix (DA)', value: 'prix'},
        { text: 'Actions', value: 'actions', sortable: false },
      ],
      services: [],
      categories : [],
      editedIndex: -1,
      editedItem: {
        partenaire: '',
        titre:'',
        description:'',
        prix: 0,
        numero:'',
        image:null,
      },
      defaultItem: {
        partenaire: '',
        titre:'',
        description:'',
        prix: 0,
        numero:'',
        image:null,
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Nouveau Service' : 'Modifier le Service'
      },
      imageUrl(){
        if(this.editedIndex > -1){
          return 'http://127.0.0.1:8000/public/images' + this.editedItem.image ;
        }
        return "";
      }
    },

    watch: {
      dialog (val) {
        val || this.close()
      },
    },

    created () {
      this.initialize()
    },

    methods: {
      initialize () {
          let obj = this;
          axios.get(`http://127.0.0.1:8000/api/service`)
          .then(function (response) {
            obj.services = response.data.data;
          })
          .catch(function (error) {  
          console.log(error);
          });
      },
      editItem (item) {
        this.editedIndex = this.services.indexOf(item);
        this.editedItem = Object.assign({}, item);
        this.editedItem.image = null ;
        this.dialog = true;
      },
      deleteItem (item) {
        this.editedIndex = this.services.indexOf(item);
        this.dialog1 = true;
      },
      viewImage (item) {
        this.editedIndex = this.services.indexOf(item);
        this.editedItem = Object.assign({}, item);
        this.dialog2 = true;
      },
      close () {
        this.dialog = false;
        this.dialog1 = false;
        this.dialog2 = false;
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem);
          this.editedIndex = -1;
        })
      },
      save () {
        let obj = this ;
        if (this.editedIndex > -1) {
            const formData = new FormData();
            formData.append('partenaire',obj.editedItem.partenaire);
            formData.append('titre',obj.editedItem.titre);
            formData.append('description',obj.editedItem.description);
            formData.append('numero',obj.editedItem.numero);
            formData.append('prix',obj.editedItem.prix);
          axios.post(`http://127.0.0.1:8000/api/service/update/${obj.services[obj.editedIndex].id}`,formData)
          .then(function (response) {
           /* obj.services[obj.editedIndex].partenaire = obj.editedItem.partenaire;
            obj.services[obj.editedIndex].titre = obj.editedItem.titre;
            obj.services[obj.editedIndex].description = obj.editedItem.description;
            obj.services[obj.editedIndex].numero= obj.editedItem.numero;
            obj.services[obj.editedIndex].prix = obj.editedItem.prix; */
            console.log(response.data);
          })
          .catch(function (error) {    
            console.log(error);
          });
        } else {
            if((obj.editedItem.partenaire!='')&&(obj.editedItem.titre!='')&&(obj.editedItem.description!='')&&(obj.editedItem.numero!='')&&(obj.editedItem.prix!=0)){
            const formData = new FormData();
            formData.append('partenaire',obj.editedItem.partenaire);
            formData.append('titre',obj.editedItem.titre);
            formData.append('description',obj.editedItem.description);
            formData.append('numero',obj.editedItem.numero);
            formData.append('prix',obj.editedItem.prix);
            if(obj.editedItem.image!=null){
              formData.append('image',obj.editedItem.image);
            }
            axios.post(`http://127.0.0.1:8000/api/service/store`,formData)
            .then(function (response) {
              obj.services.push(response.data.data);
              console.log(response.data);
            })
            .catch(function (error) {    
              console.log(error.response.data.errors);
            });
          }
          }
        this.close()
      },
      del(){
        let obj = this;
        axios.delete(`http://127.0.0.1:8000/api/service/delete/${obj.services[obj.editedIndex].id}`)
        .then(function (response) {
          console.log(response.data);
          obj.services.splice(obj.editedIndex, 1);
        })
        .catch(function (error) {  
        console.log(error);
        });
        this.close()
      }
    },
  }
</script>

<style scoped>

</style>