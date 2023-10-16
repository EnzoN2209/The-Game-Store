import javax.swing.*;
import java.awt.*;
import java.awt.event.*;
import javax.swing.table.DefaultTableModel;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.sql.*;

public class HelloWord extends JFrame {
    private JTextField nomField, prenomField, telephoneField;
    private JTextArea reclamationField;
    private DefaultTableModel tableModel;
    private Connection conn;
    private JButton soumettreButton, modifierButton, supprimerButton;
    private JComboBox<String> demandeComboBox, etatComboBox;

    public HelloWord() {
        setTitle("Service apres vente");
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);

        // Initialisation du tableau
        String[] columnNames = {"Nom", "Prenom", "Telephone", "Reclamation", "Date", "Etat", "Demande"};
        tableModel = new DefaultTableModel(columnNames, 0) {
            @Override
            public boolean isCellEditable(int row, int column) {
                return false;
            }
        };

        // Interface utilisateur (formulaire et tableau)
        JPanel panel = new JPanel(new BorderLayout());

        // Formulaire
        JPanel formPanel = new JPanel(new GridBagLayout());
        GridBagConstraints gbc = new GridBagConstraints();
        gbc.insets = new Insets(5, 5, 5, 5);

        nomField = new JTextField(20);
        prenomField = new JTextField(20);
        telephoneField = new JTextField(20);
        reclamationField = new JTextArea(5, 20);
        soumettreButton = new JButton("Soumettre");
        modifierButton = new JButton("Modifier");
        supprimerButton = new JButton("Supprimer");
        demandeComboBox = new JComboBox<>(new String[]{"Reparation", "Modification", "Suppression"});
        etatComboBox = new JComboBox<>(new String[]{"En cours", "Termine", "En attente"});

        gbc.gridx = 0;
        gbc.gridy = 0;
        formPanel.add(new JLabel("Nom:"), gbc);
        gbc.gridx = 1;
        formPanel.add(nomField, gbc);

        gbc.gridx = 0;
        gbc.gridy = 1;
        formPanel.add(new JLabel("Prenom:"), gbc);
        gbc.gridx = 1;
        formPanel.add(prenomField, gbc);

        gbc.gridx = 0;
        gbc.gridy = 2;
        formPanel.add(new JLabel("Telephone:"), gbc);
        gbc.gridx = 1;
        formPanel.add(telephoneField, gbc);

        gbc.gridx = 0;
        gbc.gridy = 3;
        formPanel.add(new JLabel("Reclamation:"), gbc);
        gbc.gridx = 1;
        formPanel.add(new JScrollPane(reclamationField), gbc);

        gbc.gridx = 0;
        gbc.gridy = 4;
        formPanel.add(new JLabel("Etat:"), gbc);
        gbc.gridx = 1;
        formPanel.add(etatComboBox, gbc);

        gbc.gridx = 0;
        gbc.gridy = 5;
        formPanel.add(new JLabel("Demande:"), gbc);
        gbc.gridx = 1;
        formPanel.add(demandeComboBox, gbc);

        gbc.gridx = 0;
        gbc.gridy = 6;
        formPanel.add(soumettreButton, gbc);

        gbc.gridx = 1;
        formPanel.add(modifierButton, gbc);
        gbc.gridx = 2;
        formPanel.add(supprimerButton, gbc);

        // Tableau
        JTable table = new JTable(tableModel);
        JScrollPane scrollPane = new JScrollPane(table);

        // Ajout des composants au panneau principal
        panel.add(formPanel, BorderLayout.NORTH);
        panel.add(scrollPane, BorderLayout.CENTER);

        // Connexion à la base de données (assurez-vous d'ajuster les détails de connexion)
        try {
            Class.forName("com.mysql.jdbc.Driver");
            conn = DriverManager.getConnection("jdbc:mysql://localhost:3308/ppe?useSSL=false&useUnicode=true&characterEncoding=UTF-8&serverTimezone=UTC", "root", "");
        } catch (SQLException e) {
            JOptionPane.showMessageDialog(null, "Erreur lors de la connexion à la base de donnees : " + e.getMessage(), "Erreur de Connexion", JOptionPane.ERROR_MESSAGE);
            e.printStackTrace();
            System.exit(1); // Quitte l'application en cas d'échec de la connexion
        } catch (ClassNotFoundException e) {
            e.printStackTrace();
        }

        // Action du bouton Soumettre
        soumettreButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String nom = nomField.getText();
                String prenom = prenomField.getText();
                String telephone = telephoneField.getText();
                String reclamation = reclamationField.getText();
                SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
                String date = sdf.format(new Date());
                String etat = (String) etatComboBox.getSelectedItem();
                String demande = (String) demandeComboBox.getSelectedItem();

                if (!nom.isEmpty() && !prenom.isEmpty() && !telephone.isEmpty() && !reclamation.isEmpty()) {
                    String[] rowData = {nom, prenom, telephone, reclamation, date, etat, demande};
                    tableModel.addRow(rowData);

                    // Ajouter les données à la base de données (ajustez la requête selon votre schéma)
                    try {
                        String sql = "INSERT INTO dossier_sav (nom, prenom, telephone, reclamation, date, etat, `Demande Client`) VALUES (?, ?, ?, ?, ?, ?, ?)";
                        PreparedStatement statement = conn.prepareStatement(sql);
                        statement.setString(1, nom);
                        statement.setString(2, prenom);
                        statement.setString(3, telephone);
                        statement.setString(4, reclamation);
                        statement.setString(5, date);
                        statement.setString(6, etat);
                        statement.setString(7, demande);
                        statement.executeUpdate();
                        statement.close();
                    } catch (SQLException ex) {
                        ex.printStackTrace();
                    }

                    // Effacer les champs après soumission
                    nomField.setText("");
                    prenomField.setText("");
                    telephoneField.setText("");
                    reclamationField.setText("");
                } else {
                    JOptionPane.showMessageDialog(HelloWord.this, "Veuillez remplir tous les champs.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        // Action du bouton Modifier
        modifierButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                int selectedRow = table.getSelectedRow();
                if (selectedRow != -1) {
                    String nom = nomField.getText();
                    String prenom = prenomField.getText();
                    String telephone = telephoneField.getText();
                    String reclamation = reclamationField.getText();
                    SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
                    String date = sdf.format(new Date());
                    String etat = (String) etatComboBox.getSelectedItem();
                    String demande = (String) demandeComboBox.getSelectedItem();

                    // Créer une nouvelle fenêtre de modification
                    JFrame editFrame = new JFrame("Modifier la Reclamation");
                    editFrame.setDefaultCloseOperation(JFrame.DISPOSE_ON_CLOSE);
                    editFrame.setLayout(new GridLayout(7, 2));

                    // Remplir les champs avec les données de la ligne sélectionnée
                    JTextField editNomField = new JTextField(nom);
                    JTextField editPrenomField = new JTextField(prenom);
                    JTextField editTelephoneField = new JTextField(telephone);
                    JTextArea editReclamationField = new JTextArea(reclamation, 5, 20);
                    JComboBox<String> editEtatComboBox = new JComboBox<>(new String[]{"En cours", "Termine", "En attente"});
                    editEtatComboBox.setSelectedItem(etat);
                    JComboBox<String> editDemandeComboBox = new JComboBox<>(new String[]{"Reparation", "Modification", "Suppression"});
                    editDemandeComboBox.setSelectedItem(demande);
                    JButton envoyerButton = new JButton("Envoyer");

                    // Ajouter les composants à la fenêtre de modification
                    editFrame.add(new JLabel("Nom:"));
                    editFrame.add(editNomField);
                    editFrame.add(new JLabel("Prenom:"));
                    editFrame.add(editPrenomField);
                    editFrame.add(new JLabel("Telephone:"));
                    editFrame.add(editTelephoneField);
                    editFrame.add(new JLabel("Reclamation:"));
                    editFrame.add(new JScrollPane(editReclamationField));
                    editFrame.add(new JLabel("Etat:"));
                    editFrame.add(editEtatComboBox);
                    editFrame.add(new JLabel("Demande:"));
                    editFrame.add(editDemandeComboBox);
                    editFrame.add(new JLabel()); // Espacement
                    editFrame.add(envoyerButton);

                    // Action du bouton Envoyer dans la fenêtre de modification
                    envoyerButton.addActionListener(new ActionListener() {
                        @Override
                        public void actionPerformed(ActionEvent e) {
                            // Mettre à jour les valeurs dans le tableau
                            tableModel.setValueAt(editNomField.getText(), selectedRow, 0);
                            tableModel.setValueAt(editPrenomField.getText(), selectedRow, 1);
                            tableModel.setValueAt(editTelephoneField.getText(), selectedRow, 2);
                            tableModel.setValueAt(editReclamationField.getText(), selectedRow, 3);
                            tableModel.setValueAt(editEtatComboBox.getSelectedItem(), selectedRow, 5);
                            tableModel.setValueAt(editDemandeComboBox.getSelectedItem(), selectedRow, 6);

                            // Fermer la fenêtre de modification
                            editFrame.dispose();
                        }
                    });

                    // Afficher la fenêtre de modification
                    editFrame.pack();
                    editFrame.setVisible(true);
                } else {
                    JOptionPane.showMessageDialog(HelloWord.this, "Veuillez selectionner une ligne à modifier.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        // Action du bouton Supprimer
        supprimerButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                int selectedRow = table.getSelectedRow();
                if (selectedRow != -1) {
                    tableModel.removeRow(selectedRow);
                    // Mettez ici le code pour supprimer la ligne sélectionnée dans la base de données
                    // Utilisez table.getValueAt(selectedRow, columnIndex) pour obtenir les valeurs des cellules
                    // ...
                } else {
                    JOptionPane.showMessageDialog(HelloWord.this, "Veuillez selectionner une ligne à supprimer.", "Erreur", JOptionPane.ERROR_MESSAGE);
                }
            }
        });

        // Fermeture de la connexion à la base de données lors de la fermeture de l'application
        addWindowListener(new WindowAdapter() {
            @Override
            public void windowClosing(WindowEvent e) {
                try {
                    if (conn != null && !conn.isClosed()) {
                        conn.close();
                    }
                } catch (SQLException ex) {
                    ex.printStackTrace();
                }
            }
        });

        // Affichage de l'interface utilisateur
        add(panel);
        pack();
        setLocationRelativeTo(null);
        setVisible(true);
    }

    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> new HelloWord());
    }
}
