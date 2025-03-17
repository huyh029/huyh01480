package tools;

import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import java.util.Collections;

public class Player {
    private ObservableList<Card> cards;

    public ObservableList<Card> getCards() {
        return cards;
    }

    public void setCards(ObservableList<Card> cards) {
        if (cards != null) sort(cards);
        this.cards = cards;
    }
    
    public ObservableList<Card> sort(ObservableList<Card> cards) {
        for (int i = 0; i < cards.size(); i++) {
            for (int j = 0; j < i; j++) {
                if (compare(cards.get(i), cards.get(j))) {
                    Collections.swap(cards, j, i);
                }
            }
        }
        return cards;
    }

    public boolean compare(Card card1, Card card2) {
        if (getValueRank(card1) < getValueRank(card2)) return true;
        if (getValueRank(card2) < getValueRank(card1)) return false;
        if (getValueSuit(card1) < getValueSuit(card2)) return true;
        return false;
    }

    private int getValueRank(Card card) {
        String[] ranks = {"3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K", "A", "2"};
        for (int i = 0; i < 13; i++) {
            if (card.getRank().equals(ranks[i])) return i;
        }
        return -1;
    }

    private int getValueSuit(Card card) {
        String[] suits = {"♥", "♦", "♣", "♠"};
        for (int i = 0; i < 4; i++) {
            if (card.getSuit().equals(suits[i])) return (3 - i);
        }
        return -1;
    }

    public void showCards() {
        int index = 0;
        for (Card card : cards) {
            System.out.print(card.getCard() + "(" + index + ")" + " ");
            index++;
        }
        System.out.print("\n");
    }
}
