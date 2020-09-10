<template>
    <v-container fluid>
    <v-navigation-drawer
      app
      clipped
      color="#11999e"
    >
      <v-list dense>
        <v-list-item>
            <v-list-item-avatar size="70">
              <img src="../assets/logo.png">
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title> <h4> Sos Shop </h4> </v-list-item-title>
              <v-list-item-subtitle> WE GO WHERE  </v-list-item-subtitle>
              <v-list-item-subtitle> THE BUSINESS IS </v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>

          <v-divider></v-divider>

        <v-list-item to="/admin/acheteur">
          <v-list-item-action>
            <v-icon>mdi-account</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title> Clients </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item to="/admin/vendeur">
          <v-list-item-action>
            <v-icon> mdi-store </v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title> Boutiques </v-list-item-title>
          </v-list-item-content>
        </v-list-item> 

         <v-list-item to="/admin/produit">
          <v-list-item-action>
          <v-icon> mdi-package-variant </v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title> Produits </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item to="/admin/publicite">
          <v-list-item-action>
            <v-icon> mdi-view-carousel </v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title> Publicités </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         
        <v-list-item to="/admin/commande">
          <v-list-item-action>
            <v-icon> mdi-shopping </v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title> Commandes (Panier) </v-list-item-title>
          </v-list-item-content>
        </v-list-item> 


        <v-list-item to="/admin/livraison">
          <v-list-item-action>
            <v-icon>mdi-truck</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title> Commandes (Livraison) </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

          <v-list-item to="/admin/service">
          <v-list-item-action>
            <v-icon> mdi-layers </v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title> Services </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item to="/admin/categorie">
          <v-list-item-action>
            <v-icon>mdi-view-week</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title> Catégories </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

         <v-list-item to="/admin/souscategorie">
            <v-list-item-action>
              <v-icon>mdi-view-module</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title> Sous-Catégories </v-list-item-title>
            </v-list-item-content>
          </v-list-item>

        <v-list-item to="/admin/contact">
          <v-list-item-action>
            <v-icon>mdi-forum</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title> Messages Réçus </v-list-item-title>
          </v-list-item-content>
        </v-list-item>  

        <v-list-item to="/admin/faq">
          <v-list-item-action>
            <v-icon>mdi-help-circle</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title> FAQ </v-list-item-title>
          </v-list-item-content>
        </v-list-item>

      </v-list>
    </v-navigation-drawer>
    </v-container>
</template>

<script>
    export default {
      methods: {
      },  
    }
</script>

<style scoped>

</style>