package gameInterface;

import java.util.ArrayList;

import javafx.beans.property.IntegerProperty;
import javafx.beans.property.SimpleIntegerProperty;
import javafx.collections.FXCollections;
import javafx.collections.ListChangeListener;
import javafx.collections.ObservableList;
import gameLogic.LogicGame;
import gameLogic.LogicTienLenMienBac;
import javafx.geometry.Pos;
import javafx.scene.Node;
import javafx.scene.Scene;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Pane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import tools.Deck;
import tools.Player;
import tools.Card;

public class GameInterface extends Scene {
	private ArrayList<Player> players;
	private BorderPane root;
	private Pane center;
	private IntegerProperty index;
	private LogicGame game;
	private boolean basic;
	public GameInterface(Stage primaryStage ,LogicGame logicGame, boolean basic){
        super(new BorderPane(), 800, 800);
        root = (BorderPane) getRoot();
        game = logicGame;
        this.basic = basic;
        index = new SimpleIntegerProperty();
        index.bind(game.getIndex());
        root.setStyle("-fx-background-color: red;");
        center = game.getCenter();
        players = game.getPlayers();
        setArea();
        index.addListener((observable, oldValue, newValue) -> {
            setArea();
        });
    }
	private void setArea() {
    	Pane cardPlayer;
    	Pane buttonPlayer;
    	Pane areaPlayer;
        switch(players.size()-1) {
        case 3:
        	root.setLeft(creatAreaPlayer(3));
        case 2:
        	root.setTop(creatAreaPlayer(2));
        case 1: 
        	root.setRight(creatAreaPlayer(1));
        case 0:
        	root.setBottom(creatAreaPlayer(0));
        }
        root.setCenter(center);
    }
    private Pane creatCardPlayer(int indexPlayer) {
    	Pane cardPlayer;
    	if(indexPlayer%2==0) {
    		cardPlayer = new HBox(basic?5:-60);
        	((HBox) cardPlayer).setAlignment(Pos.CENTER);
        	
    	} else {
    		cardPlayer = new VBox(basic?5:-90);
        	((VBox) cardPlayer).setAlignment(Pos.CENTER);
    	}
    	cardPlayer.getChildren().addAll(this.players.get(indexPlayer).getCards());
    	for(Node card : cardPlayer.getChildren() )  {
    		card.setOnMouseClicked(e->{
    			if(card.getTranslateX()==0&&card.getTranslateY()==0) {
	    			switch(indexPlayer) {
	        		case 3:
	        			card.setTranslateX(10);
	        			break;
	        		case 2:
	        			card.setTranslateY(10);
	        			break;
	        		case 1:
	        			card.setTranslateX(-10);
	        			break;
	        		case 0:
	        			card.setTranslateY(-10);
	        			break;
	        		}
    			} else {
    				card.setTranslateX(0);
    				card.setTranslateY(0);
    			}
    		});
    	}
    	return cardPlayer;
    }
    private Pane creatAreaPlayer(int indexPlayer) {
    	Pane areaPlayer;
    	if(indexPlayer%2==0) 
    		areaPlayer = new VBox(20);
    	else
    		areaPlayer = new HBox(20);
    	if(indexPlayer/2==0) 
        	areaPlayer.getChildren().addAll(creatButtonPlayer(indexPlayer),creatCardPlayer(indexPlayer));
    	else
    		areaPlayer.getChildren().addAll(creatCardPlayer(indexPlayer),creatButtonPlayer(indexPlayer));
    	return areaPlayer;
    }
    private Pane creatButtonPlayer(int indexPlayer) {
    	if(index.get() != indexPlayer) return new Pane(); 
    	Pane buttonPlayer;
    	if(indexPlayer%2==0) {
    		buttonPlayer = new HBox(20);
        	((HBox) buttonPlayer).setAlignment(Pos.CENTER);
        	
    	} else {
    		buttonPlayer = new VBox(20);
        	((VBox) buttonPlayer).setAlignment(Pos.CENTER);
    	}
    	buttonPlayer.getChildren().addAll(game.showButton().getChildren());
    	return buttonPlayer;
    }
   
}
