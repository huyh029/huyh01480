package tools;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;

public class Deck {
    private ObservableList<Card> cards;

    public Deck(boolean basic) {
        String[] ranks = {"A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"};
        String[] suits = {"♠", "♥", "♦", "♣"};
        cards = FXCollections.observableArrayList();
        for (String suit : suits) {
            for (String rank : ranks) {
               if(basic) cards.add(new Card(rank, suit, basic));
               else cards.add(new Card(rank, suit));
            }
        }
        shuffle();
    }

    // Lấy danh sách các lá bài
    public ObservableList<Card> getCards() {
        return cards;
    }

    // Xáo trộn bộ bài
    public void shuffle() {
        java.util.Collections.shuffle(cards);
    }

    // Rút lá bài từ đầu bộ bài
    public Card draw() {
        if (!cards.isEmpty()) {
            return cards.remove(0);
        }
        return null; // Trả về null nếu bộ bài rỗng
    }

    // Phương thức chia bài cho người chơi
    public ObservableList<Card> deal(int amount) {
        ObservableList<Card> hand = FXCollections.observableArrayList();
        for (int i = 0; i < amount; i++) {
            hand.add(draw());
        }
        return hand;
    }
}
