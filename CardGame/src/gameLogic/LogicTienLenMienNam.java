package gameLogic;

import javafx.application.Platform;
import javafx.beans.property.IntegerProperty;
import javafx.beans.property.SimpleIntegerProperty;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.geometry.Pos;

import java.util.ArrayList;
import java.util.Scanner;

import application.Home;
import gameInterface.GameInterface;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.layout.HBox;
import javafx.scene.layout.Pane;
import javafx.scene.layout.VBox;
import javafx.stage.Stage;
import tools.AI;
import tools.Card;
import tools.Deck;
import tools.Player;

public class LogicTienLenMienNam implements LogicGame{
    private ObservableList<Card> oldCard;
    private ObservableList<Card> newCard;
    private ObservableList<Card> selectionCard;
    private ArrayList<Integer> cycle;
    private ArrayList<Player> players;
    private ArrayList<Boolean> aIs;
    private AI aI;
    private Pane center;
    private int countPlayer;
    private int countAI;
    private IntegerProperty index;
    private Deck deck;
    private boolean basic;
    private Stage primaryStage;
    public LogicTienLenMienNam(Stage primaryStage,int countPlayer, int countAI, boolean basic) {
    	this.primaryStage = primaryStage;
    	this.basic = basic;
    	oldCard = FXCollections.observableArrayList();
    	newCard = FXCollections.observableArrayList();
    	players = new ArrayList<Player>();
    	aI = new AI(this); 
    	this.countPlayer = countPlayer;
        this.countAI = countAI;
    	index = new SimpleIntegerProperty(0);
    	center = new HBox(basic?5:-60);
        center.setStyle("-fx-border-color: yellow; -fx-border-width: 5; -fx-border-radius: 500px;");
        ((HBox) center).setAlignment(Pos.CENTER);
        restart();
    }
    private void restart() {
    	deck = new Deck(basic);
    	setCycle();
    	setAI();
    	players.clear();
    	for(int i=0 ; i<countPlayer ; i++ ) {
			creatPlayer();
		}
        center.getChildren().clear();
        oldCard.clear();
        int tmp = index.get();
        index.set(-1);
        index.set(tmp);
        useAI();
    }
    private void creatPlayer() {
		Player player = new Player();
		player.setCards(deck.deal(13));
		players.add(player);
	}
    @Override
	public ArrayList<Player> getPlayers() {
		return players;
	}
	private void setAI() {
		aIs = new ArrayList<Boolean>();
		for(int i=0 ; i<countPlayer-countAI ; i++ ) {
			aIs.add(false);
		}
		for(int i=countPlayer-countAI ; i<countPlayer ; i++ ) {
			aIs.add(true);
		}
	}
	@Override
    public Pane getCenter() {
    	return center;
    }
	public void setPlayers(ArrayList<Player> players) {
		this.players = players;
	}
	public void setAI(ArrayList<Boolean> aIs) {
		this.aIs = aIs;
	}
	@Override
	public IntegerProperty getIndex() {
		return index;
	}

	public void setNewCard() {
        this.newCard = getSelectionCard();
    }

    private void setCycle() {
        cycle = new ArrayList<>();
        for (int i = 0; i < countPlayer; i++) {
            cycle.add(i);
        }
    }

    private void play() {
    	if(isFinish()) {return;}
    	if(!aIs.get(index.get())) setNewCard();
        if (check(newCard,oldCard)) {
        	Integer oldIndex = index.get();
        	oldCard = newCard;
            players.get(oldIndex).getCards().removeAll(newCard);
            center.getChildren().clear();
            center.getChildren().addAll(newCard);
            nextTurn();
        }
    }
    
    public ObservableList<Card> getOldCard() {
    	return oldCard;
    }

    private void nextTurn() {
    	if(isFinish()) {finish();return;}
    	int currentIndex = cycle.indexOf(index.get())+1;
    	if(currentIndex == cycle.size()) currentIndex = 0;
    	index.set(cycle.get(currentIndex));
    	useAI();
    }
    
    private void useAI() {
    	if (!aIs.get(index.get())) {
    	    return;
    	}
    	newCard = aI.getNewCard(players.get(index.get()).getCards(), oldCard);

    	if (!newCard.isEmpty()) {
    	    // Tạo một luồng mới để xử lý hiệu ứng
    	    new Thread(() -> {
    	        for (int i = 0; i < newCard.size(); i++) {
    	            int currentIndex = i; // Biến cần final để sử dụng trong lambda

    	            // Thực hiện setTranslateX trong JavaFX Application Thread
    	            Platform.runLater(() -> {
    	            	switch(index.get()) {
    	            	case 0:
    	            		newCard.get(currentIndex).setTranslateY(-10);
    	            		break;
    	            	case 1:
    	            		newCard.get(currentIndex).setTranslateX(-10);
    	            		break;
    	            	case 2:
    	            		newCard.get(currentIndex).setTranslateY(10);
    	            		break;
    	            	case 3:
    	            		newCard.get(currentIndex).setTranslateX(10);
    	            		break;
    	            	}
    	            	
    	                 // Hiệu ứng setTranslateX
    	            });

    	            // Ngủ 100ms giữa các phần tử
    	            try {
    	                Thread.sleep(100);
    	            } catch (InterruptedException e) {
    	                e.printStackTrace();
    	            }
    	        }

    	        // Sau khi hoàn thành, chờ thêm 1 giây và gọi play()
    	        try {
    	            Thread.sleep(1000); // Chờ 1 giây
    	        } catch (InterruptedException e) {
    	            e.printStackTrace();
    	        }

    	        // Gọi play() trong JavaFX Application Thread
    	        Platform.runLater(() -> play());
    	    }).start();
    	} else {
    	    // Nếu newCard rỗng, chờ 1 giây rồi gọi pass()
    	    new Thread(() -> {
    	        try {
    	            Thread.sleep(1000); // Chờ 1 giây
    	        } catch (InterruptedException e) {
    	            e.printStackTrace();
    	        }

    	        // Gọi pass() trong JavaFX Application Thread
    	        Platform.runLater(() -> pass());
    	    }).start();
    	}

    }
    
    private void pass() {
    	if(isFinish()) {return;}
    	if(oldCard.isEmpty()) return;
    	int tmp = index.get();
    	if(cycle.size()==2) {
    		oldCard.clear();
    		center.getChildren().clear();
    	}
    	nextTurn();
    	cycle.remove(Integer.valueOf(tmp));
    	if(cycle.size()==1) {
    		setCycle();
    	}
    }
    private boolean isFinish() {
    	return players.get(index.get()).getCards().isEmpty();
    }
    private void finish() {
        	VBox finish = new VBox(0);
        	finish.setAlignment(Pos.CENTER);
        	
        	Label winer = new Label("player "+(index.get()+1)+" win");
        	winer.setStyle("-fx-font-size: 30px; -fx-text-fill: white;");
        	
        	HBox lastCards = new HBox(basic?5:-60);
        	lastCards.setAlignment(Pos.CENTER);
        	
        	HBox retry = new HBox(10);
        	retry.setAlignment(Pos.CENTER);
        	
        	lastCards.getChildren().addAll(oldCard);
        	Button retryButton = new Button("chơi lại");
        	retryButton.setOnMouseClicked(e->{
        		restart();
        	});
        	setStyleButton(retryButton);
        	Button exitButton = new Button("thoát");
        	setStyleButton(exitButton);
        	exitButton.setOnMouseClicked(e->{
        		primaryStage.setScene(new Home(primaryStage));
        	});
        	retry.getChildren().addAll(retryButton,exitButton);
        	finish.getChildren().addAll(lastCards,winer,retry);
        	center.getChildren().add(finish);
    }
    @Override
    public Pane showButton() {
        Pane areaButton = new Pane();
        Button play = new Button("đánh");
        setStyleButton(play);
        Button pass = new Button("bỏ");
        setStyleButton(pass);
        play.setOnMouseClicked(e -> {
            play();
        });
        pass.setOnMouseClicked(e -> {
            pass();
        });
        areaButton.getChildren().addAll(pass,play);
        return areaButton;
    }
    
    private void setStyleButton(Button button) {
        button.setStyle("-fx-pref-width: 70px;"
                + "    -fx-pref-height: 40px;"
                + "    -fx-background-color: #FFCC00;"
                + "    -fx-text-fill: white;"
                + "    -fx-font-weight: bold;"
                + "    -fx-font-size: 14px;"
                + "    -fx-background-radius: 5;");
    }
    
    private ObservableList<Card> getSelectionCard() {
    	ObservableList<Card> newCard = FXCollections.observableArrayList();
	    for(Card selectionCard : players.get(index.get()).getCards()) {
	    	if(selectionCard.getTranslateX()!=0||selectionCard.getTranslateY()!=0) 
			{
				newCard.add((Card) selectionCard);
			}
	    }
	    return newCard;
    }
    
    
    public boolean compare(Card card1,Card card2) {
		if(getValueRank(card1)<getValueRank(card2)) return true;
		if(getValueRank(card2)<getValueRank(card1)) return false;
		if(getValueSuit(card1)<getValueSuit(card2)) return true;
		return false;
	}
	private int getValueRank(Card card) {
		String[] ranks = {"3","4","5","6","7","8","9","10","J","Q","K","A","2"};
		for(int i=0;i<13;i++) {
			if(card.getRank().equals(ranks[i])) return i;
		}
		return -1;
	}
	private int getValueSuit(Card card) {
		String[] suits = { "♥", "♦", "♣","♠"};
		for(int i=0;i<4;i++) {
			if(card.getSuit().equals(suits[i])) return (3-i);
		}
		return -1;
	}
	private boolean checkCoc(ObservableList<Card> card) {
		if(card.size() == 1) return true;
		return false;
	}
	private boolean checkSame(ObservableList<Card> card) {
		if(card.size() >= 2) {
			for(int i=0; i<card.size()-1;i++)
			{
				if(getValueRank(card.get(i))!=getValueRank(card.get(i+1))) return false;
			}
		}
		else return false;
		return true;
	}
	private boolean checkSanh(ObservableList<Card> card) {
		if(card.size()<3||getValueRank(card.getLast())==12) return false;
		for(int i=0 ;i<card.size()-1;i++) {
			if(getValueRank(card.get(i))!=getValueRank(card.get(i+1))-1) return false;
		}
		return true;
	}
	private boolean checkDoiThong(ObservableList<Card> card) {
		if(card.size()<6||getValueRank(card.getLast())==12||card.size()%2==1||getValueRank(card.get(0))!=getValueRank(card.get(1))) return false;
		for(int i=0 ;i<card.size()-2;i+=2) {
			if(getValueRank(card.get(i))!=getValueRank(card.get(i+2))-1) return false;
		}
		for(int i=1 ;i<card.size()-1;i+=2) {
			if(getValueRank(card.get(i))!=getValueRank(card.get(i+2))-1) return false;
		}
		return true;
	}
	private String checkType(ObservableList<Card> card) {
		if(checkCoc(card)) return "coc";
		if(checkSanh(card)) return "sanh";
		if(checkSame(card)) {
			if(card.size()==2) return "doi";
			if(card.size()==3) return "boBa";
			if(card.size()==4) return "tuQuy";
		}
		if(checkDoiThong(card)) {
			if(card.size()==6) return "baDoiThong";
			if(card.size()==8) return "bonDoiThong";
			if(card.size()==10) return "namDoiThong";
		}
		return "";
	}
	@Override
	public boolean check(ObservableList<Card> newCard, ObservableList<Card> oldCard) {
		String oldCardType = checkType(oldCard);
	    String newCardType = checkType(newCard);
	    if(newCardType.equals("")) return false;
	    if (oldCard.size() == 0) return true;
	    if (getValueRank(oldCard.get(0)) == 12) { 
	        if (oldCardType.equals("boBa")) return false;
	    }
	    if (newCardType.equals(oldCardType) &&
	        newCard.size() == oldCard.size() &&
	        compare(oldCard.getLast(), newCard.getLast())) return true;
	    
	    if(oldCard.size()==1&&getValueRank(oldCard.get(0))==12) {
	    	if (newCardType.equals("bonDoiThong")) return true;
	    	if (newCardType.equals("baDoiThong")) return true;
	    	if (newCardType.equals("tuQuy")) return true;
	    }
	    if(oldCard.size()==2&&getValueRank(oldCard.get(0))==12) {
	    	if (newCardType.equals("bonDoiThong")) return true;
	    	if (newCardType.equals("tuQuy")) return true;
	    }
	    if (oldCardType.equals("baDoiThong")) {
	        if (newCardType.equals("bonDoiThong") || newCardType.equals("tuQuy")) return true;
	    }

	    if (oldCardType.equals("tuQuy")) {
	        if (newCardType.equals("bonDoiThong")) return true;
	    }

	    return false;
	}
}
