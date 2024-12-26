package gameLogic;

import java.util.ArrayList;

import javafx.beans.value.ObservableValue;
import javafx.collections.ObservableList;
import javafx.scene.layout.Pane;
import tools.Card;
import tools.Player;

public interface LogicGame {
	ObservableValue<? extends Number> getIndex();
	Pane getCenter();
	ArrayList<Player> getPlayers();
	Pane showButton();
	boolean check(ObservableList<Card> newCard, ObservableList<Card> oldCard);
}
