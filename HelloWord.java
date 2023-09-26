import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.table.DefaultTableModel;


public class HelloWord {

    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> {
            JFrame fenetre = new JFrame("Service après vente");
            DefaultTableModel model = new DefaultTableModel(new Object[]{"Nom", "Prénom", "Téléphone", "Réclamation", "Option", "Action"}, 0) {
                @Override
                public boolean isCellEditable(int row, int column) {
                    return false; // Empêcher l'édition des cellules
                }
            };

            JTable table = new JTable(model); // Initialisation du tableau

            // Créer un JPanel pour l'en-tête et le bouton
            JPanel headerPanel = new JPanel(new BorderLayout()); // Utilisation d'un BorderLayout
            headerPanel.setBackground(Color.BLACK); // En-tête en noir

            // Créer un JPanel pour le titre "Aprevou" et le logo à gauche
            JPanel titlePanel = new JPanel(new FlowLayout(FlowLayout.LEFT)); // Alignement à gauche
            titlePanel.setOpaque(false); // Fond transparent

            // Charger l'image "logo.png" à partir du chemin complet (ajustez le chemin si nécessaire)
            ImageIcon logoImage = new ImageIcon("C:\\wamp64\\www\\Javatest\\logo.png");

            // Redimensionner le logo (ajustez la largeur souhaitée, par exemple 200)
            Image image = logoImage.getImage().getScaledInstance(200, -1, Image.SCALE_SMOOTH);

            // Créer une nouvelle ImageIcon redimensionnée
            ImageIcon logoRedimensionne = new ImageIcon(image);

            JLabel imageEtiquette = new JLabel(logoRedimensionne);

            // Ajouter les composants au titrePanel
            titlePanel.add(imageEtiquette);

            // Ajouter le titrePanel au headerPanel
            headerPanel.add(titlePanel, BorderLayout.WEST);

            // Créer un JPanel pour le formulaire
            JPanel formulairePanel = new JPanel(new GridBagLayout());
            GridBagConstraints gbc = new GridBagConstraints();
            formulairePanel.setPreferredSize(new Dimension(800, 200)); // Taille du formulaire

            // Ajouter de l'espace entre les champs
            gbc.insets = new Insets(5, 5, 5, 5); // Espacement

            // Créer des étiquettes et des champs de texte pour le formulaire
            JLabel nomLabel = new JLabel("Nom:");
            JTextField nomField = new JTextField(20);

            JLabel emailLabel = new JLabel("Prénom:");
            JTextField emailField = new JTextField(20);

            JLabel localisationLabel = new JLabel("Téléphone:");
            JTextField localisationField = new JTextField(20);

            JLabel reclamationLabel = new JLabel("Réclamation:");
            JTextField reclamationField = new JTextField(20);

            // Ajouter les composants au formulaire en utilisant GridBagConstraints
            gbc.gridx = 0;
            gbc.gridy = 0;
            formulairePanel.add(nomLabel, gbc);

            gbc.gridx = 1;
            gbc.gridy = 0;
            formulairePanel.add(nomField, gbc);

            gbc.gridx = 0;
            gbc.gridy = 1;
            formulairePanel.add(emailLabel, gbc);

            gbc.gridx = 1;
            gbc.gridy = 1;
            formulairePanel.add(emailField, gbc);

            gbc.gridx = 0;
            gbc.gridy = 2;
            formulairePanel.add(localisationLabel, gbc);

            gbc.gridx = 1;
            gbc.gridy = 2;
            formulairePanel.add(localisationField, gbc);

            gbc.gridx = 0;
            gbc.gridy = 3;
            formulairePanel.add(reclamationLabel, gbc);

            gbc.gridx = 1;
            gbc.gridy = 3;
            formulairePanel.add(reclamationField, gbc);

            // Créer un JComboBox pour les options
            String[] options = {"Réparation", "Retour", "Réclamation"};
            JComboBox<String> comboBox = new JComboBox<>(options);

            // Ajouter un écouteur pour le JComboBox
            comboBox.addActionListener(new ActionListener() {
                @Override
                public void actionPerformed(ActionEvent e) {
                    // Récupérer les valeurs des champs de texte et de l'option sélectionnée
                    String nom = nomField.getText();
                    String email = emailField.getText();
                    String localisation = localisationField.getText();
                    String reclamation = reclamationField.getText();
                    String choix = (String) comboBox.getSelectedItem();

                    // Vérifier si les champs ne sont pas vides
                    if (!nom.isEmpty() && !email.isEmpty() && !localisation.isEmpty() && !reclamation.isEmpty() && choix != null) {
                        JOptionPane.showMessageDialog(
                                fenetre,
                                "Formulaire soumis avec succès!\n\n" +
                                        "Nom du client: " + nom + "\n" +
                                        "Adresse e-mail: " + email + "\n" +
                                        "Localisation: " + localisation + "\n" +
                                        "Réclamation: " + reclamation + "\n" +
                                        "Option sélectionnée : " + choix,
                                "Formulaire soumis",
                                JOptionPane.INFORMATION_MESSAGE
                        );
                    } else {
                        JOptionPane.showMessageDialog(
                                fenetre,
                                "Veuillez remplir tous les champs et sélectionner une option.",
                                "Erreur de formulaire",
                                JOptionPane.ERROR_MESSAGE
                        );
                    }
                }
            });

            // Ajouter le JComboBox en dessous du champ Réclamation
            gbc.gridx = 0;
            gbc.gridy = 4;
            gbc.gridwidth = 2; // Le JComboBox occupe deux colonnes
            formulairePanel.add(comboBox, gbc);

            // Créer un bouton pour soumettre le formulaire
            JButton soumettreButton = new JButton("Soumettre");
            soumettreButton.addActionListener(new ActionListener() {
                @Override
                public void actionPerformed(ActionEvent e) {
                    // Récupérer les valeurs des champs de texte et de l'option sélectionnée
                    String nom = nomField.getText();
                    String email = emailField.getText();
                    String localisation = localisationField.getText();
                    String reclamation = reclamationField.getText();
                    String choix = (String) comboBox.getSelectedItem();

                    // Vérifier si les champs ne sont pas vides
                    if (!nom.isEmpty() && !email.isEmpty() && !localisation.isEmpty() && !reclamation.isEmpty() && choix != null) {
                        // Ajouter les données soumises à un tableau
                        String[] rowData = {nom, email, localisation, reclamation, choix};
                        model.addRow(rowData); // Ajouter la ligne de données
                    } else {
                        JOptionPane.showMessageDialog(
                                fenetre,
                                "Veuillez remplir tous les champs et sélectionner une option.",
                                "Erreur de formulaire",
                                JOptionPane.ERROR_MESSAGE
                        );
                    }
                }
            });

            // Ajouter le bouton "Soumettre" en dessous du champ Réclamation
            gbc.gridx = 0;
            gbc.gridy = 5;
            gbc.gridwidth = 2; // Le bouton occupe deux colonnes
            formulairePanel.add(soumettreButton, gbc);

            // Créer un JPanel pour le formulaire et le tableau (disposition verticale)
            JPanel mainPanel = new JPanel();
            mainPanel.setLayout(new BoxLayout(mainPanel, BoxLayout.Y_AXIS));
            mainPanel.add(formulairePanel);
            mainPanel.add(new JScrollPane(table));

            // Ajouter l'en-tête et le formulaire au conteneur principal
            fenetre.add(headerPanel, BorderLayout.NORTH);
            fenetre.add(mainPanel, BorderLayout.CENTER);

            // Définir la taille de la fenêtre
            fenetre.setSize(800, 600);
            fenetre.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
            fenetre.setVisible(true);
        });
    }
}
