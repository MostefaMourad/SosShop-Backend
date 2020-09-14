<template>

  <v-data-table
    :headers="headers"
    :items="produits"
    sort-by="partenaire"
    class="elevation-1"
  >

    <template v-slot:top>

      <v-toolbar flat>

        <v-toolbar-title> Mes Produits ( Produits Sos Shop ) </v-toolbar-title>

        <v-divider
          class="mx-4"
          inset
          vertical
        >
        </v-divider>
        <v-spacer></v-spacer>
        <v-dialog v-model="dialog" max-width="660px">
          <template v-slot:activator="{ on, attrs }">
            <v-btn
              color="#11999e"
              dark
              class="mb-2" 
              v-bind="attrs"
              v-on="on" 
            > Ajouter un Produit </v-btn>
          </template>

          <v-card light>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>
            <v-card-text>
              <v-text-field color="#11999e" outlined  v-model="editedItem.titre" label="Titre"></v-text-field>
              <v-row>
                  <v-col md="6">
                    <v-text-field color="#11999e" type="number" outlined  v-model="editedItem.prix" label="Prix (DA)"></v-text-field>
                  </v-col>
                  <v-col md="6">
                    <v-text-field color="#11999e" type="number" outlined  v-model="editedItem.quantite" label="Quantité"></v-text-field>
                  </v-col>
              </v-row>
               <v-row>
                  <v-col md="6">
                      <v-select
                        :items="dataCat"
                        v-model="editedItem.categorie"
                        label="Catégorie"
                        outlined
                        color="#11999e"
                        ></v-select>
                  </v-col>
                  <v-col md="6">
                      <v-select
                        :items="dataSCat"
                        v-model="editedItem.sous_categorie"
                        label="Sous-Catégorie"
                        outlined
                        color="#11999e"
                    ></v-select>
                  </v-col>
              </v-row>

              <v-row>
                  <v-col md="4">
                    <v-text-field color="#11999e" type="number" outlined  v-model="editedItem.poids" label="Poids (Kg)"></v-text-field>
                  </v-col>
                  <v-col md="4">
                    <v-text-field color="#11999e" outlined  v-model="editedItem.marque" label="Marque"></v-text-field>
                  </v-col>
                  <v-col md="4">
                      <v-select
                        :items="couleurs"
                        v-model="editedItem.couleur"
                        label="Couleur"
                        outlined
                        color="#11999e"
                    ></v-select>
                  </v-col>
              </v-row>

              <v-row>
                  <v-col md="4">
                    <v-text-field color="#11999e" type="number" outlined  v-model="editedItem.longueur" label="Longueur (m)"></v-text-field>
                  </v-col>
                  <v-col md="4">
                    <v-text-field color="#11999e" type="number" outlined  v-model="editedItem.largeur" label="Largeur (m)"></v-text-field>
                  </v-col>
                  <v-col md="4">
                    <v-text-field color="#11999e" type="number" outlined  v-model="editedItem.hauteur" label="Hauteur (m)"></v-text-field>
                  </v-col>
              </v-row>

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
                multiple
                show-size
                counter
                label="Photo du produit"
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
              <span class="headline"> Supprimer le Produit ? </span>
            </v-card-title>
            <v-card-text>
              Si vous poursuivez cette action, vous supprimerez le Produit définitivement .
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="grey" text @click="close()" >Annuler</v-btn>
              <v-btn color="red" text @click="del()" >Supprimer</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>

        <v-dialog light v-model="dialog2" max-width="850px">
          <template>
            <v-btn
              color="#00adb5"
              dark
              class="mb-2"
              v-show="false"
            ></v-btn>
          </template>
          <v-card max-height="500px">
            &nbsp;&nbsp;&nbsp;&nbsp;
            <v-card-text>
                <v-row align="center">
                    <v-col md="5">
                         <v-carousel hide-delimiter-background height="300px" > 
                            <v-carousel-item
                            v-for="(item,i) in items"
                            cycle
                            :key="i"
                            max-height="300px"
                            :src="item.src"
                            reverse-transition="fade-transition"
                            transition="fade-transition"
                            ></v-carousel-item>
                        </v-carousel>
                    </v-col>
                    <v-col md="7">
                        <h4> - <strong> Catégorie </strong>  : {{editedItem.categorie}}  </h4>
                        <h4> - <strong> Sous-Catégorie </strong>  : {{editedItem.sous_categorie}}  </h4>
                        <h4> - <strong> Poids </strong>  : {{editedItem.poids}} ( kilogrammes ) </h4>
                        <h4> - <strong> Couleur </strong>  : {{editedItem.couleur}}  </h4>
                        <h4> - <strong> Longueur </strong>  : {{editedItem.longueur}} ( mètres ) </h4>
                        <h4> - <strong> Largeur </strong> : {{editedItem.largeur}} ( mètres ) </h4>
                        <h4> - <strong> Hauteur </strong> : {{editedItem.hauteur}} ( mètres ) </h4>
                    </v-col>
                </v-row>
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
        mdi-clipboard-text
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
        items: [
        {
        src: 'https://cdn.vuetifyjs.com/images/carousel/squirrel.jpg',
        },
        {
        src: 'https://cdn.vuetifyjs.com/images/carousel/sky.jpg',
        },
        {
        src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg',
        },
        {
        src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg',
        },
        ],
      dialog: false,
      dialog1:false,
      dialog2:false,
      error:false,
      headers: [
       {text:'Titre',align :'left',value:'titre'},
       {text:'Description',align :'left',value:'description',sortable: false},
       {text:'Prix(DA)',align :'left',value:'prix'},
       {text:'Marque',align :'left',value:'marque',sortable: false},
       {text:'Quantité',align :'left' , value:'quantite',sortable: false},
       { text: 'Actions', value: 'actions', sortable: false },
      ],
      couleurs :[
        'Noir','Bleu','Marron','Or','Vert','Gris','Orange','Rose','Violet','Rouge','Argent','Blanc','Jaune' 
      ],
      produits: [],
      categories : [],
      sous_categories : [],
      editedIndex: -1,
      editedItem: {
        titre:'',
        description:'',
        prix: 0,
        marque:'',
        quantite:0,
        couleur:'',
        poids:0.0,
        longueur:0.0,
        largeur:0.0,
        hauteur:0.0,
        categorie:'',
        sous_categorie:'',
        image:null,
      },
      defaultItem: {
        titre:'',
        description:'',
        prix: 0,
        marque:'',
        quantite:0,
        couleur:'',
        poids:0.0,
        longueur:0.0,
        largeur:0.0,
        hauteur:0.0,
        categorie:'',
        sous_categorie:'',
        image:null,
      },
    }),

    computed: {
      formTitle () {
        return this.editedIndex === -1 ? 'Nouveau Produit' : 'Modifier les détails du produit'
      },
      imageUrl(){
        if(this.editedIndex > -1){
          return 'http://127.0.0.1:8000/public/images' + this.editedItem.image ;
        }
        return "";
      },
      dataCat() {
        let cats =  this.categories.map(cat => {
          return cat.nom ;
        });
        return cats;
      },
      dataSCat() {
        if((this.editedItem.categorie != "")&&(this.error!=true)&&(this.dialog2!=true)){
            var categ = this.categories.find(o => o.nom === this.editedItem.categorie);
            let catss =  this.sous_categories.filter(scat => {
                if(scat.categorie_id == categ.id){
                    return scat.nom;
                }
            });
            let cats =  catss.map(cat => {
                return cat.nom ;
            });
            return cats;
        }
        else{
            let cats =  this.sous_categories.map(Scat => {
              return Scat.nom ;
            });
            return cats;
        }  
      },
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
          axios.get(`http://127.0.0.1:8000/api/produit/sos`)
          .then(function (response) {
            obj.produits = response.data.data;
          })
          .catch(function (error) {  
          console.log(error);
          });
          axios.get(`http://127.0.0.1:8000/api/categorie`)
          .then(function (response) {
            obj.categories = response.data.data;
          })
          .catch(function (error) {  
          console.log(error);
          });
          axios.get(`http://127.0.0.1:8000/api/souscategorie`)
          .then(function (response) {
            obj.sous_categories = response.data.data;
          })
          .catch(function (error) {  
          console.log(error);
          });
      },
      editItem (item) {
        this.editedIndex = this.produits.indexOf(item);
        this.editedItem = Object.assign({}, this.produits[this.editedIndex]);
        var scat = this.sous_categories.find(o => o.id === (this.produits[this.editedIndex]).sous_categorie_id);
        var cat = this.categories.find(o => o.id === (this.produits[this.editedIndex]).categorie_id); 
        this.editedItem.categorie  = cat.nom;
        this.editedItem.sous_categorie = scat.nom;   
        this.editedItem.image = null ;
        this.dialog = true;
        this.error = true;
      },
      deleteItem (item) {
        this.editedIndex = this.produits.indexOf(item);
        this.dialog1 = true;
      },
      viewImage (item) {
        this.editedIndex = this.produits.indexOf(item);
        this.editedItem = Object.assign({}, item);
        var scat = this.sous_categories.find(o => o.id === (this.produits[this.editedIndex]).sous_categorie_id);
        var cat = this.categories.find(o => o.id === (this.produits[this.editedIndex]).categorie_id); 
        this.editedItem.categorie  = cat.nom;
        this.editedItem.sous_categorie = scat.nom;
        this.dialog2 = true;
      },
      close () {
        this.dialog = false;
        this.dialog1 = false;
        this.dialog2 = false;
        this.error = false;
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem);
          this.editedIndex = -1;
        })
      },
      save () {
        let obj = this ;
        if (this.editedIndex > -1) {
            const formData = new FormData();   
            formData.append('marque',obj.editedItem.marque);
            formData.append('titre',obj.editedItem.titre);
            formData.append('description',obj.editedItem.description);
            formData.append('quantite',obj.editedItem.quantite);
            formData.append('prix',obj.editedItem.prix);
            formData.append('prix_promotionnel',obj.editedItem.prix);
            formData.append('couleur',obj.editedItem.couleur);
            formData.append('poids',obj.editedItem.poids);
            formData.append('longueur',obj.editedItem.longueur);
            formData.append('largeur',obj.editedItem.largeur);
            formData.append('hauteur',obj.editedItem.hauteur);
            axios.patch(`http://127.0.0.1:8000/api/produit/update/${obj.produits[obj.editedIndex].id}`,formData)
            .then(function (response) {
            /* obj.produits[obj.editedIndex].partenaire = obj.editedItem.partenaire;
                obj.produits[obj.editedIndex].titre = obj.editedItem.titre;
                obj.produits[obj.editedIndex].description = obj.editedItem.description;
                obj.produits[obj.editedIndex].numero= obj.editedItem.numero;
                obj.produits[obj.editedIndex].prix = obj.editedItem.prix; */
                console.log(response.data);

            })
          .catch(function (error) {    
            console.log(error);
          });
        } else {
            if((obj.editedItem.marque!='')&&(obj.editedItem.titre!='')&&(obj.editedItem.description!='')&&(obj.editedItem.couleur!='')&&(obj.editedItem.prix!=0)&&(obj.editedItem.poids!=0)&&(obj.editedItem.largeur!=0)&&(obj.editedItem.longueur!=0)&&(obj.editedItem.hauteur!=0)&&(obj.editedItem.categorie!="")&&(obj.editedItem.sous_categorie!="")){
            const formData = new FormData();
            formData.append('marque',obj.editedItem.marque);
            formData.append('titre',obj.editedItem.titre);
            formData.append('description',obj.editedItem.description);
            formData.append('quantite',obj.editedItem.quantite);
            formData.append('prix',obj.editedItem.prix);
            formData.append('prix_promotionnel',obj.editedItem.prix);
            formData.append('couleur',obj.editedItem.couleur);
            formData.append('poids',obj.editedItem.poids);
            formData.append('longueur',obj.editedItem.longueur);
            formData.append('largeur',obj.editedItem.largeur);
            formData.append('hauteur',obj.editedItem.hauteur);
            var scat = obj.sous_categories.find(o => o.nom === obj.editedItem.sous_categorie);
            formData.append('categorie_id',scat.categorie_id);
            formData.append('sous_categorie_id',scat.id);
            formData.append('espace_vendeur_id',1);
            if(obj.editedItem.image!=null){
                for( var i = 0; i < obj.editedItem.image.length; i++ ){
                    let img = obj.editedItem.image[i];
                    formData.append('image[' + i + ']', img);
                }
            }
            axios.post(`http://127.0.0.1:8000/api/produit/store`,formData)
            .then(function (response) {
              obj.produits.push(response.data.data);
              console.log(response.data);
            })
            .catch(function (error) {    
              console.log(error.response.data);
            });
            }
            }
        this.close();
      },
      del(){
        let obj = this;
        axios.delete(`http://127.0.0.1:8000/api/produit/delete/${obj.produits[obj.editedIndex].id}`)
        .then(function (response) {
          console.log(response.data);
          obj.produits.splice(obj.editedIndex, 1);
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