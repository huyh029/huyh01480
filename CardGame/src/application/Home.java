package application;

import gameInterface.GameInterface;
import gameLogic.LogicGame;
import gameLogic.LogicTienLenMienBac;
import gameLogic.LogicTienLenMienNam;
import javafx.geometry.Pos;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.RadioButton;
import javafx.scene.control.Toggle;
import javafx.scene.control.ToggleGroup;
import javafx.scene.layout.HBox;
import javafx.scene.layout.VBox;
import javafx.scene.paint.Color;
import javafx.scene.text.Font;
import javafx.stage.Stage;
import tools.Card;

public class Home extends Scene {

    public Home(Stage primaryStage) {
        super(new VBox(20), 1000, 800);
        VBox layout = (VBox) getRoot();
        layout.setAlignment(Pos.CENTER);
        layout.setStyle("-fx-background-color: red;");

        HBox playerSelection = new HBox(50);
        playerSelection.setAlignment(Pos.CENTER);

        ToggleGroup playerGroup = new ToggleGroup();
        RadioButton twoPlayers = new RadioButton("2 Người chơi");
        RadioButton threePlayers = new RadioButton("3 Người chơi");
        RadioButton fourPlayers = new RadioButton("4 Người chơi");

        styleRadioButton(twoPlayers);
        styleRadioButton(threePlayers);
        styleRadioButton(fourPlayers);

        twoPlayers.setToggleGroup(playerGroup);
        threePlayers.setToggleGroup(playerGroup);
        fourPlayers.setToggleGroup(playerGroup);
        playerSelection.getChildren().addAll(twoPlayers, threePlayers, fourPlayers);
        
        HBox modeSelection = new HBox(20);
        modeSelection.setAlignment(Pos.CENTER);

        ToggleGroup modeGroup = new ToggleGroup();
        RadioButton modeBasic = new RadioButton("cơ bản");
        RadioButton modeAdvance = new RadioButton("nâng cao");

        styleRadioButton(modeBasic);
        styleRadioButton(modeAdvance);

        modeBasic.setToggleGroup(modeGroup);
        modeAdvance.setToggleGroup(modeGroup);

        modeSelection.getChildren().addAll(modeBasic,modeAdvance);

        HBox aiSelection = new HBox(20);
        aiSelection.setAlignment(Pos.CENTER);

        ToggleGroup aiGroup = new ToggleGroup();
        RadioButton noAI = new RadioButton("Không có AI");
        RadioButton oneAI = new RadioButton("1 AI");
        RadioButton twoAI = new RadioButton("2 AI");
        RadioButton threeAI = new RadioButton("3 AI");
        RadioButton fourAI = new RadioButton("4 AI");

        styleRadioButton(noAI);
        styleRadioButton(oneAI);
        styleRadioButton(twoAI);
        styleRadioButton(threeAI);
        styleRadioButton(fourAI);

        noAI.setToggleGroup(aiGroup);
        oneAI.setToggleGroup(aiGroup);
        twoAI.setToggleGroup(aiGroup);
        threeAI.setToggleGroup(aiGroup);
        fourAI.setToggleGroup(aiGroup);

        aiSelection.getChildren().addAll(noAI, oneAI, twoAI, threeAI, fourAI);

        HBox buttons = new HBox(20);
        buttons.setAlignment(Pos.CENTER);

        Button tlmnButton = new Button("Tiến lên miền nam");
        Button tlmbButton = new Button("Tiến lên miền bắc");

        styleButton(tlmnButton);
        styleButton(tlmbButton);

        tlmnButton.setOnAction(e -> {
        	 int countPlayer = getSelectedPlayerCount(playerGroup);
             int countAI = getSelectedAICount(aiGroup);
             boolean basicMode = getSelectedMode(modeGroup);
             primaryStage.setScene(new GameInterface(primaryStage,
            		 new LogicTienLenMienNam(primaryStage,countPlayer,countAI,basicMode),
            		 basicMode));
             primaryStage.setFullScreen(true);
        });
        tlmbButton.setOnAction(e -> {
        	int countPlayer = getSelectedPlayerCount(playerGroup);
            int countAI = getSelectedAICount(aiGroup);
            boolean basicMode = getSelectedMode(modeGroup);

            primaryStage.setScene(new GameInterface(primaryStage,
           		 new LogicTienLenMienBac(primaryStage,countPlayer,countAI,basicMode),
           		 basicMode));
            primaryStage.setFullScreen(true);
        });

        buttons.getChildren().addAll(tlmnButton, tlmbButton);

        layout.getChildren().addAll(playerSelection, aiSelection,modeSelection,  buttons);
    }

    private int getSelectedPlayerCount(ToggleGroup playerGroup) {
        RadioButton selected = (RadioButton) playerGroup.getSelectedToggle();
        if (selected != null) {
            switch (selected.getText()) {
                case "2 Người chơi":
                    return 2;
                case "3 Người chơi":
                    return 3;
                case "4 Người chơi":
                    return 4;
                default:
                    return 2;
            }
        }
        return 2;
    }

    private int getSelectedAICount(ToggleGroup aiGroup) {
        RadioButton selected = (RadioButton) aiGroup.getSelectedToggle();
        if (selected != null) {
            switch (selected.getText()) {
                case "Không có AI":
                    return 0;
                case "1 AI":
                    return 1;
                case "2 AI":
                    return 2;
                case "3 AI":
                    return 3;
                case "4 AI":
                	return 4;
                default:
                    return 0;
            }
        }
        return 0;
    }
    
    private boolean getSelectedMode(ToggleGroup modeGroup) {
        RadioButton selected = (RadioButton) modeGroup.getSelectedToggle();
        if (selected != null) {
            switch (selected.getText()) {
                case "cơ bản":
                    return true;
                case "nâng cao":
                    return false;
            }
        }
        return false;
    }

    private void styleRadioButton(RadioButton radioButton) {
        radioButton.setFont(Font.font(30));
        radioButton.setTextFill(Color.WHITE);
    }

    private void styleButton(Button button) {
        button.setFont(Font.font(30));
        button.setStyle("-fx-background-color: orange; -fx-text-fill: white;");
    }
}
